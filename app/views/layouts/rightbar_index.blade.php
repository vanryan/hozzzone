<div id="rightBar" class="rightBar">
    <div class="layout">
        <ul class="viewer" id="viewLayout">
            <li class="default{{ $viewer === 'default' ? ' active' : '' }}" id="layoutButton-1"><i></i></li>
            <li class="square{{ $viewer === 'square' ? ' active' : '' }}" id="layoutButton-2"><i></i></li>
            <li class="brick{{ $viewer === 'brick' ? ' active' : '' }}" id="layoutButton-3"><i></i></li>
        </ul>
    </div>
    <a class="add" id="addHoz">添加</a>
    <div class="search">
        <form class="searchForm" id="searchForm">
            <input type="text" class="search-text" placeholder="寻找..">
            <button class="search-img" type="submit"></button>
        </form>
    </div>
    <div class="hot">
        <div class="users">
            <h3 class="header">最近热门用户</h3>
            <div class="slide">
                <ul>
                    <li><a href=""><img src="" alt=""></a></li>
                    <li><a href=""><img src="" alt=""></a></li>
                    <li><a href=""><img src="" alt=""></a></li>
                    <li><a href=""><img src="" alt=""></a></li>
                </ul>
            </div>
        </div>
    </div>
    <a id="backToTop" class="backToTop" href="#">顶部</a>
</div>
