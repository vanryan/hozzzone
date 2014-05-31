<div id="rightBar" class="rightBar">
    <div class="layout">
        <ul class="viewer" id="viewLayout">
            <li class="default{{ $viewer === 'default' ? ' active' : '' }}" id="layoutButton-1"><a href="#"></a></li>
            <li class="square{{ $viewer === 'square' ? ' active' : '' }}" id="layoutButton-2"><a href="#"></a></li>
            <li class="brick{{ $viewer === 'brick' ? ' active' : '' }}" id="layoutButton-3"><a href="#"></a></li>
        </ul>
    </div>
    <a class="add" id="addHoz">添加</a>
    <div class="search">
        <form>
            <div class="searchBox" id="searchBox">
                <input type="text" class="search-text" placeholder="寻找..">
                <em class="search-img"></em>
            </div>
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
