<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>{{ Session::get('tenant.name') }} @yield('meta_title')</title>

    <link href="/assets/css/admin.min.css" rel="stylesheet">
    <script src="/assets/js/modernizr.min.js"></script>
</head>
<body class="{{ Request::segment(2) }}">
    @include('admin.partials.alerts')
    @include('admin.partials.navbar')
    <div class="page-container">
        @include('admin.partials.sidebar')
        <div class="content">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
</html>

