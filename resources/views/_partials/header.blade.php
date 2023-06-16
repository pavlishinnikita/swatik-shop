<header>
    @php
        use Illuminate\Support\Facades\Redis;
        $players = json_decode(Redis::get('server_players'), true) ?? ['online' => 0, 'max' => 0];
    @endphp
    @section('header')
    <div class="header__section with-wine">
        <div class="header__item headerlogo en-text">
            <a href="/">{{config('app.appName')}}</a>
            <div class="server-users-container">
                <div>
                    <progress max="<?=$players['max']?>" value="<?=$players['online']?>"></progress>
                </div>
                <p>
                    <span><?=$players['online']?></span>/<span><?=$players['max']?></span>
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
