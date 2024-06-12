<html>
    <head>
        <meta charset="utf-8"/>
        <meta id="_viewport" name="viewport" content="width=device-width, initial-scale=1.0"/>
        {!! $page->getTitle() !!}
        {!! $page->getMeta() !!}
        <link rel="apple-touch-icon" sizes="180x180" href="/partners/{{$config['partner']}}/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/partners/{{$config['partner']}}/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/partners/{{$config['partner']}}/favicon-16x16.png">
        <link rel="manifest" href="/partners/{{$config['partner']}}/site.webmanifest">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="/css/foundation/foundation.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&display=swap" rel="stylesheet">
        <link href="/css/fontawesome/css/all.min.css" rel="stylesheet">
        <style>
            :root {
                --ca-action: #BF0F30;
            }
        </style>
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16506920005"></script>
        <script>
            window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16506920005');
            gtag('config', 'AW-16506920005/KkZACP7n17AZEMW4jr89', {
                'phone_conversion_number':  '{{$config['telephone']['number']}}',
                'phone_conversion_css_class': 'cta_telephone'
            });
        </script>


        <link rel="stylesheet" href="/css/master.css">
        {!! $page->getCSSInline('top') !!}
        {!! $page->getCSS('top') !!}
        {!! $page->getJSInline('top') !!}
        {!! $page->getJS('top') !!}
    </head>
    <body id="{{$config['partner']}}-body">
        @include('partials/masthead')
        @yield('content')
        @include('partials/footer')
        {!! $page->addCSS('<link rel="stylesheet" href="/assets' . $config['css'] . '">','top') !!}
        {!! $page->getCSSInline('bottom') !!}
        {!! $page->getCSS('bottom') !!}
        {!! $page->getJSInline('bottom') !!}
        {!! $page->getJS('bottom') !!}
    </body>
</html>
