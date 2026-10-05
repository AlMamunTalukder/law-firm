# Static exporter for GitHub Pages (github.io)
# Exports ONLY: home (/) -> index.html, contact (/contact) -> contact.html
# - downloads all locally-referenced assets (css/js/images/storage files)
# - rewrites absolute site URLs to relative static links
# - HIDES every link/button/section that points to non-exported pages
#   (nothing in the project itself is changed or deleted)
#
# Usage:  powershell -ExecutionPolicy Bypass -File .\export-static.ps1
# Output: .\static-site\  -> push the CONTENTS to your GitHub repo

$Port = "8099"
$Base = "http://127.0.0.1:$Port"
$OutDir = Join-Path $PSScriptRoot "static-site"
$PhpExe = "C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe"
$ServePrefix = "http://127.0.0.1:$Port"

function Get-Page([string]$Path) {
    $r = Invoke-WebRequest -Uri ($ServePrefix + $Path) -UseBasicParsing -TimeoutSec 60
    if ($r.StatusCode -ne 200) { throw "GET $Path returned $($r.StatusCode)" }
    return $r.Content
}

Write-Host "== starting php artisan serve on $Port =="
$job = Start-Job -ScriptBlock {
    Set-Location $using:PSScriptRoot
    $env:Path = "C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64;C:\laragon\bin\composer;" + $env:Path
    php artisan serve --port=$using:Port 2>&1
}
Start-Sleep -Seconds 8

try {
    if (Test-Path $OutDir) { Remove-Item -LiteralPath $OutDir -Recurse -Force }
    New-Item -ItemType Directory -Path $OutDir | Out-Null

    # ---------- 1. fetch pages ----------
    Write-Host "== fetching pages =="
    $PageDefs = @(
        @{ Path="/"; File="index.html" },
        @{ Path="/contact"; File="contact.html" },
        @{ Path="/details/info/about"; File="about.html" },
        @{ Path="/our-team"; File="team.html" },
        @{ Path="/news/category/News"; File="insights.html" },
        @{ Path="/image"; File="gallery.html" },
        @{ Path="/video"; File="videos.html" }
    )
    $Pages = @()
    foreach ($d in $PageDefs) {
        Write-Host "  GET $($d.Path)"
        $Pages += @{ File=$d.File; Html=(Get-Page $d.Path) }
    }
    # article slugs referenced by home/insights pages
    $slugSet = New-Object System.Collections.Generic.HashSet[string]
    foreach ($pg in $Pages) {
        foreach ($m in ([regex]'(?:href="|window\.location='')(?:https?://127\.0\.0\.1:[0-9]+)?/news/([A-Za-z0-9_-]+)').Matches($pg.Html)) {
            $s = $m.Groups[1].Value
            if ($s -ne 'category') { [void]$slugSet.Add($s) }
        }
    }
    foreach ($s in $slugSet) {
        Write-Host "  GET /news/$s"
        try { $Pages += @{ File=("news-" + $s + ".html"); Html=(Get-Page ("/news/" + $s)) } }
        catch { Write-Host "  !! skip article $s" }
    }

    # ---------- 2. collect local asset URLs ----------
    $assetPaths = New-Object System.Collections.Generic.HashSet[string]
    foreach ($pg in $Pages) { $h = $pg.Html

        foreach ($m in ([regex]'(?:src|href)\s*=\s*"((?:https?://127\.0\.0\.1:[0-9]+)?/[^"]+)"').Matches($h)) {
            $u = $m.Groups[1].Value -replace '\?.*$', ''
            if ($u -match '\.(css|js|png|jpg|jpeg|webp|gif|svg|ico|woff2?|ttf|eot)($|/)') {
                $p = $u -replace '^https?://127\.0\.0\.1:[0-9]+', ''
                [void]$assetPaths.Add($p)
            }
        }
    }
    Write-Host "== downloading $($assetPaths.Count) assets =="
    foreach ($p in $assetPaths) {
        $dest = Join-Path $OutDir ($p.TrimStart('/') -replace '/', '\')
        $dir = Split-Path $dest -Parent
        if (!(Test-Path $dir)) { New-Item -ItemType Directory -Path $dir -Force | Out-Null }
        try {
            Invoke-WebRequest -Uri ($ServePrefix + $p) -UseBasicParsing -TimeoutSec 60 -OutFile $dest
        } catch { Write-Host "  !! skip $p ($($_.Exception.Message))" }
    }

    # ---------- 3. assets referenced inside downloaded CSS (fonts etc.) ----------
    Get-ChildItem (Join-Path $OutDir "front_assets") -Recurse -Filter *.css -ErrorAction SilentlyContinue | ForEach-Object {
        $cssFile = $_.FullName
        $cssDirUrl = ((Split-Path $cssFile -Parent).Substring($OutDir.Length) -replace '\\', '/')
        $txt = Get-Content -LiteralPath $cssFile -Raw
        foreach ($m in ([regex]'url\(\s*["'']?([^"'')]+)["'']?\s*\)').Matches($txt)) {
            $u = $m.Groups[1].Value
            if ($u -match '^(data:|https?://|#)') { continue }
            $full = $cssDirUrl + '/' + ($u -replace '\?.*$', '')
            $full = $full -replace '/\./', '/'
            while ($full -match '/[^/]+/\.\./') { $full = $full -replace '/[^/]+/\.\./', '/' }
            $dest = Join-Path $OutDir ($full.TrimStart('/') -replace '/', '\')
            if (!(Test-Path $dest)) {
                $dir = Split-Path $dest -Parent
                if (!(Test-Path $dir)) { New-Item -ItemType Directory -Path $dir -Force | Out-Null }
                try { Invoke-WebRequest -Uri ($ServePrefix + $full) -UseBasicParsing -TimeoutSec 60 -OutFile $dest }
                catch { Write-Host "  !! skip css asset $full" }
            }
        }
    }

    # ---------- 4. rewrite URLs (every exported page links to a real file) ----------
    function Rewrite-Urls([string]$h) {
        $h = $h -replace [regex]::Escape($ServePrefix), ''
        # root-relative asset paths -> relative (works on user AND project pages)
        $h = [regex]::Replace($h, '(src|href)="/(front_assets|storage|build)/', '$1="$2/')
        # category / listing pages (longest first)
        $h = $h -replace 'href="/news/category/News"', 'href="insights.html"'
        $h = $h -replace 'href="/news/category/video"', 'href="videos.html"'
        $h = $h -replace 'href="/news/category/image"', 'href="gallery.html"'
        $h = $h -replace 'href="/news/location/[^"]*"', 'href="insights.html"'
        # articles: /news/{slug} (href + onclick only, never image paths) -> news-{slug}.html
        $h = [regex]::Replace($h, '(href="|window\.location='')/news/([A-Za-z0-9_-]+)', '$1news-$2.html')
        # main pages
        $h = $h -replace 'href="/details/info/about"', 'href="about.html"'
        $h = $h -replace 'href="/our-team"', 'href="team.html"'
        $h = $h -replace 'href="/teachers"', 'href="team.html"'
        $h = $h -replace 'href="/image"', 'href="gallery.html"'
        $h = $h -replace 'href="/video"', 'href="videos.html"'
        $h = $h -replace 'href="/home"', 'href="index.html"'
        $h = $h -replace 'href="/"', 'href="index.html"'
        $h = $h -replace 'href="/contact"', 'href="contact.html"'
        $h = $h -replace 'action="/contact"', 'action="#"'
        return $h
    }

    # ---------- 5. static-hosting touches (menus stay, everything resolves) ----------
    function Final-Touches([string]$h) {
        # leftover absolute dev URL inside inline JS config
        $h = $h -replace 'http:\\/\\/127\.0\.0\.1:[0-9]+', ''
        # contact form cannot POST on static hosting -> friendly note
        $h = $h -replace '<form action="#" method="POST">', '<form action="#" method="POST" onsubmit="alert(''Thanks! Please call or email us — online sending needs hosting with PHP.''); return false;">'
        return $h
    }

    foreach ($pg in $Pages) {
        $html = Final-Touches (Rewrite-Urls $pg.Html)
        [IO.File]::WriteAllText((Join-Path $OutDir $pg.File), $html)
    }
    [IO.File]::WriteAllText((Join-Path $OutDir ".nojekyll"), '')

    Write-Host "== done. Files:"
    Get-ChildItem $OutDir -Recurse -File | Measure-Object | Select-Object -ExpandProperty Count
}
finally {
    Write-Host "== stopping server =="
    Stop-Job $job -ErrorAction SilentlyContinue
    Remove-Job $job -Force -ErrorAction SilentlyContinue
}
