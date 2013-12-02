<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>@yield('meta_title')</title>
    <meta name="description" content="@yeild('meta_description')">

    <link href="/assets/css/site.min.css" rel="stylesheet">
    <script src="/assets/js/modernizr.min.js"></script>
</head>
<body>
    {{ Notification::showAll() }}

    @yield('content')

    @yield('scripts')
    
</body>
</html>

