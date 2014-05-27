<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/hozzzone/public/css/main.css">
</head>
<body>
    <div class="outer-box" id="app">
        <div class="bars">
            @yield('nav')
            @yield('rightBar')
        </div>
        <div id="main-box">
            @yield('content')
        </div>
    </div>
    <script src="/hozzzone/public/js/jquery-2.1.1.js" type="text/javascript"></script>
    <script src="/hozzzone/public/js/underscore.js" type="text/javascript"></script>
    <script src="/hozzzone/public/js/backbone.js" type="text/javascript"></script>
    <script src="/hozzzone/public/js/bundle.min.js" type="text/javascript"></script>
    @yield('js')
</body>
</html>
