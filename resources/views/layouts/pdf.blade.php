<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ public_path('css/pdf.css')}}" />

    </head>
    @page {
        header: page-header;
        footer: page-footer;
      }

    <body>

        @yield('content')

        @stack('scripts')
    </body>
</html>
