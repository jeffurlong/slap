<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>
        @section('meta_title')
        Slap
        @show
    </title>
    <meta name="description" content="
        @section('meta_description')
        Slap
        @show
    ">

    <link href="/assets/css/slap.min.css" rel="stylesheet">
    <script src="/assets/js/modernizr.min.js"></script>
</head>
<body>
    @yield('content')

    @yield('scripts')
</body>
</html>

