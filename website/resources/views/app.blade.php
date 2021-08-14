<!DOCTYPE html>
<html lang="mk">

<head>
    <title>{{config('app.name', 'Freja')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="" name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="application-name" content="{{config('app.name', 'Laravel')}}">
    <meta name="apple-mobile-web-app-title" content="{{config('app.name', 'Laravel')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600&family=Montserrat:wght@300;400;600;700;800&family=Open+Sans:wght@300;400;600;700;800&display=swap&subset=cyrillic" as="style">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600&family=Montserrat:wght@300;400;600;700;800&family=Open+Sans:wght@300;400;600;700;800&display=swap&subset=cyrillic">

    <link rel="shortcut icon" href="{{url('favicon.ico')}}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">

    <base href="{{url('/')}}">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="publisher" content="">
    <meta name="robots" content="index,follow">
    <meta name="revisit-after" content="7 days">
    <link rel="canonical" href="">

    <meta property="og:title" content="">
    <meta property="og:type" content="article">
    <meta property="og:image" content="">

    <meta property="og:url" content="">
    <meta property="og:description" content="">
    <link href="" rel="image_src">

    <script type="text/javascript">
        var baseUrl = "{{url('/api')}}";
        var baseMetaUrl = "{{url('/')}}";
        var baseDomains = @json(Config::get('app.domains'));
        var gtmKeys = @json(Config::get('constants.gtm_key'));

        window.prerenderReady = false;
    </script>
</head>

<body>
    <div id="app" class="vue-app" style="height:100%;"></div>
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>
