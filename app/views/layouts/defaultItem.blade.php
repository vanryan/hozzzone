@foreach ($items as $key=>$item)
    <li class="item" id="item-{{ $key + 1 }}">
        <div class="avatar">
            <img src="/hozzzone/public/avatar/{{ $item->avatar }}" alt="">
            <span class="name">{{ $item->authorname }}</span>
        </div>
        <div class="content">
            <div class="front">
                <a href="" class="calbum"><img src="/hozzzone/public/img/asset/{{ $item->img }}" alt=""></a>
                <div class="title">{{{ $item->title }}}</div>
                <a class="like" id="button-1"  href="#"><span>+ {{ $item->hit }}</span></a>
            </div>
            <div class="peek">
                @foreach ($item->subItems as $subItem)
                    <div class="sub-item"><a href=""><img src="/hozzzone/public/img/asset/{{ $subItem }}" alt=""></a></div>
                @endforeach
            </div>
        </div>
    </li>
@endforeach
