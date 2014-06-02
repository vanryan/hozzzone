@foreach ($items as $key=>$item)
    <li class="item" id="item-{{ $key + 1 }}">
        <div class="avatar">
            <img src="/hozzzone/public/avatar/{{ $item->upuicon }}" alt="">
            <span class="name">{{ $item->upuname }}</span>
        </div>
        <div class="content">
            <div class="front">
                <a href="" class="calbum"><img src="/hozzzone/public/img/asset/{{ $item->filename }}" alt=""></a>
                <div class="title">{{{ $item->imgtitle }}}</div>
                <a class="like" id="button-1"  href="#"><span>+ {{ $item->hits }}</span></a>
            </div>
            @if (isset($item->subItems[0]))
            <div class="peek">
                @foreach ($item->subItems as $subItem)
                    <div class="sub-item"><a href=""><img src="/hozzzone/public/img/asset/{{ $subItem }}" alt=""></a></div>
                @endforeach
            </div>
            @endif
        </div>
    </li>
@endforeach
