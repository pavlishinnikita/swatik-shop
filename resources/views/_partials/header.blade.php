<header>
    @section('header')
    <div class="header__section">
        <div class="header__item headerlogo en-text">
            <a href="/">{{config('app.appName')}}</a>
            <div class="server-users-container">
                <div>
                    <progress max="8000" value="4000"></progress>
                </div>
                <p>
                    <span>4000</span>/<span>8000</span>
                </p>
            </div>
        </div>
    </div>

    <div class="header__section">
        <div class="header__item headerButton">
            <a href="{{env('APP_VK_LINK')}}" target="_blank">ГруппаВК</a>
        </div>
        <div class="img__vk"><img src="/images/header/vk.png" alt=""></div>
        <div class="header__item headerButton">
            <a href="/goods-list" data-load-modal="goodsDetailModal" >О товарах</a>
        </div>
        <div class="img__paper"><img src="/images/header/paper.png" alt=""></div>
    </div>
    @show
</header>
