<html>
    <head>
        {!! $page->getTitle() !!}
        {!! $page->getMeta() !!}
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
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
        {!! $page->getCSSInline('bottom') !!}
        {!! $page->getCSS('bottom') !!}
        {!! $page->getJSInline('bottom') !!}
        {!! $page->getJS('bottom') !!}
    </body>
</html>
