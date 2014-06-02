@foreach ($items as $key=>$item)
<li class="item" id="item-{{ $key + 1 }}">
        <div class="content">
            <a href="">
                <div class="img-overlay">
                    <div class="shadow"></div>
                    <span class="title">{{{ $item->imgtitle }}}</span>  
                </div>
                <img src="/hozzzone/public/img/asset/{{ $item->filename }}" alt="">
            </a>      
        </div>
        <div class="info">
            <a class="like" id="button-{{ $key + 1 }}" href="#"><span>+ {{ $item->hits }}</span></a>

            <div class="avatar">
                <img src="/hozzzone/public/avatar/{{ $item->upuicon }}" alt="">
                <span class="name">{{ $item->upuname }}</span>
            </div>
        </div>
    </li>@endforeach
{{-- Note: by attaching '@endforeach' right behind the closing tag </li>, and making no indentation before the opening tag <li>, we get '</li><li>' so to avoid 'inline-block' elements to have gaps between each other. --}}
