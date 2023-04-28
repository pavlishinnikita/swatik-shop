<header>
    @section('header')
    <div class="header__section">
        <div class="header__item headerlogo">
            <a href="/">{{config('app.appName')}}</a>
        </div>
    </div>

    <div class="header__section">
        <div class="header__item headerButton">
            <a href="{{env('APP_VK_LINK')}}" target="_blank">ГруппаВК</a>
        </div>
        <div class="img__vk"><img src="/images/header/vk.png" alt=""></div>
        <div class="header__item headerButton">
            <a href="#">О товарах</a>
        </div>
        <div class="img__paper"><img src="/images/header/paper.png" alt=""></div>
    </div>
    @show
</header>
