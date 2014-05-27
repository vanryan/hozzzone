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
            @include('layouts.nav')
            @include('layouts.rightBar')
        </div>
        <div id="main-box">
            <ul class="default" id="defaultItems">
                @foreach ($items as $key=>$item)
                <li class="item" id="item-{{ $key }}">
                    <div class="avatar">
                        <img src="/hozzzone/public/img/{{ $item->avatar }}" alt="">
                        <span class="name">client</span>
                    </div>
                    <div class="content">
                        <div class="front">
                            <a href="" class="calbum"><img src="/hozzzone/public/img/{{ $item->img }}" alt=""></a>
                            <div class="title">{{{ $item->title }}}</div>
                            <a class="like" id="button-1"  href="#"><span>+ {{ $item->hit }}</span></a>
                        </div>
                        <div class="peek">
                            @foreach ($item->$subItems as $subItem)
                            <div class="sub-item"><a href=""><img src="/hozzzone/public/img/{{ $subItem }}" alt=""></a></div>
                            @endforeach
                        </div>
                    </div>
                </li>
                @endfor
            </ul>
        </div>
    </div>
    <script src="/hozzzone/public/js/jquery-2.1.1.js" type="text/javascript"></script>
    <script src="/hozzzone/public/js/underscore.js" type="text/javascript"></script>
    <script src="/hozzzone/public/js/backbone.js" type="text/javascript"></script>
    <script src="/hozzzone/public/js/bundle.min.js" type="text/javascript"></script>
    <script>

        var defaultViewerJSON = {{ $initJSON }};            
        H.init(defaultViewerJSON);
        
    </script>
</body>
