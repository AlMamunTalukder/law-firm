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
    $homeHtml = Get-Page "/"
    $contactHtml = Get-Page "/contact"

    # ---------- 2. collect local asset URLs ----------
    $assetPaths = New-Object System.Collections.Generic.HashSet[string]
    foreach ($h in @($homeHtml, $contactHtml)) {
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

    # ---------- 4. rewrite URLs ----------
    function Rewrite-Urls([string]$h) {
        $h = $h -replace [regex]::Escape($ServePrefix), ''
        # root-relative asset paths -> relative (works on user AND project pages)
        $h = [regex]::Replace($h, '(src|href)="/(front_assets|storage|build)/', '$1="$2/')
        $h = $h -replace 'href="/contact"', 'href="contact.html"'
        $h = $h -replace 'href="/home"', 'href="index.html"'
        $h = $h -replace 'href="/"', 'href="index.html"'
        $h = $h -replace 'action="/contact"', 'action="#"'
        return $h
    }

    # ---------- 5. HIDE everything that is not home/contact ----------
    function Hide-Others([string]$h, [string]$pageName) {
        # header Practice Areas + Insights dropdowns
        $h = [regex]::Replace($h, '<div class="ch-nav-drop">.*?</ul>\s*</div>', '', 'Singleline')
        # mobile menu dropdown groups + Our Team link
        $h = [regex]::Replace($h, '<li class="dropdown">.*?</ul>\s*</li>', '', 'Singleline')
        $h = [regex]::Replace($h, '<li>\s*<a[^>]*>Our Team</a>\s*</li>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*>Our Team</a>', '', 'Singleline')
        # buttons going to removed pages
        $h = [regex]::Replace($h, '<a[^>]*href="[^"]*"[^>]*>\s*Read More\s*<span>.*?</span>\s*</a>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*href="[^"]*"[^>]*>\s*View Profile\s*<span>.*?</span>\s*</a>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*href="[^"]*"[^>]*>\s*View All\s+Practice Areas\s*<span>.*?</span>\s*</a>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*href="[^"]*"[^>]*>\s*View All\s*<span>.*?</span>\s*</a>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*href="[^"]*"[^>]*>\s*Meet Our Team\s*<span>.*?</span>\s*</a>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*href="[^"]*"[^>]*>\s*See All[^<]*</a>', '', 'Singleline')
        # practice rows: link -> plain div (keep look, no destination)
        $h = [regex]::Replace($h, '<a\s+href="[^"]*"\s+class="(ch-pa-item[^"]*)">', '<div class="$1">')
        # insight cards: drop click-through
        $h = [regex]::Replace($h, '\s*onclick="window\.location=[^"]*"', '')
        # Team page is not exported -> hide its links/buttons too
        $h = [regex]::Replace($h, '<li>\s*<a[^>]*>Our Team</a>\s*</li>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*>Our Team</a>', '', 'Singleline')
        # About page is not exported -> hide its links/buttons too
        $h = [regex]::Replace($h, '<li>\s*<a[^>]*href="/details/info/about"[^>]*>\s*About\s*</a>\s*</li>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*href="/details/info/about"[^>]*>\s*About\s*</a>', '', 'Singleline')
        $h = [regex]::Replace($h, '<a[^>]*class="[^"]*ch-btn-outline[^"]*"[^>]*>.*?</a>', '', 'Singleline')
        # gallery See All (contains an icon tag inside)
        $h = [regex]::Replace($h, '<a[^>]*>\s*See All.*?</a>', '', 'Singleline')
        # footer link columns (keep brand col + bottom bar)
        $h = [regex]::Replace($h, '<div class="(?:|footer-column)">\s*<h4 class="footer-label">(?:Quick Links|Our Services|Legal Resources|Support)</h4>\s*<ul.*?</ul>\s*</div>', '', 'Singleline')
        # leftover absolute dev URL inside inline JS config
        $h = $h -replace 'http:\\/\\/127\.0\.0\.1:[0-9]+', ''
        # contact form cannot POST on static hosting -> friendly note
        $h = $h -replace '<form action="#" method="POST">', '<form action="#" method="POST" onsubmit="alert(''Thanks! Please call or email us — online sending needs hosting with PHP.''); return false;">'
        return $h
    }

    $homeHtml = Hide-Others (Rewrite-Urls $homeHtml) "home"
    $contactHtml = Hide-Others (Rewrite-Urls $contactHtml) "contact"

    [IO.File]::WriteAllText((Join-Path $OutDir "index.html"), $homeHtml)
    [IO.File]::WriteAllText((Join-Path $OutDir "contact.html"), $contactHtml)
    [IO.File]::WriteAllText((Join-Path $OutDir ".nojekyll"), '')

    Write-Host "== done. Files:"
    Get-ChildItem $OutDir -Recurse -File | Measure-Object | Select-Object -ExpandProperty Count
}
finally {
    Write-Host "== stopping server =="
    Stop-Job $job -ErrorAction SilentlyContinue
    Remove-Job $job -Force -ErrorAction SilentlyContinue
}
