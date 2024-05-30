<html>
<head>
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
        html, body {
            box-sizing: border-box;
            height: 100%;
            padding: 0;
            margin: 0;
        }
        .page_wrapper {
            box-sizing: border-box;
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        .header, footer {
            flex-grow: 0;
            flex-shrink: 0;
        }
        .page_content {
            flex-grow: 1;
        }
    </style>
    <link rel="stylesheet" href="/css/master.css">
    {!! $page->getCSSInline('top') !!}
    {!! $page->getCSS('top') !!}
    {!! $page->getJSInline('top') !!}
    {!! $page->getJS('top') !!}
</head>
<body id="{{$config['partner']}}-body">
    <div class="page_wrapper">
        @include('partials/round/header')
        <div class="page_content">
            @yield('content')
        </div>
        @include('partials/footer')
    </div>
    {!! $page->addCSS('<link rel="stylesheet" href="/assets' . $config['css'] . '">','top') !!}
    {!! $page->getCSSInline('bottom') !!}
    {!! $page->getCSS('bottom') !!}
    {!! $page->getJSInline('bottom') !!}
    {!! $page->getJS('bottom') !!}
</body>
</html>
