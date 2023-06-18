<header>
    @php
        use Illuminate\Support\Facades\Redis;
        $players = json_decode(Redis::get('server_players'), true) ?? ['online' => 0, 'max' => 0];
    @endphp
    @section('header')
    <div class="header__section with-wine">
        <div class="headerlogo en-text">
            <a id="header_app_name" data-ip="{{env('RCON_HOST')}}" href="/">{{config('app.appName')}}</a>
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
            <a class="link" href="{{env('APP_VK_LINK')}}" target="_blank"></a>
            <span>Группа ВК</span>
            <div class="mi_image"><img src="/images/header/vk.png" alt=""></div>
        </div>
        <div class="header__item headerButton">
            <a class="link" href="/goods-list" data-load-modal="goodsDetailModal" ></a>
            <span>О товарах</span>
            <div class="mi_image"><img src="/images/header/paper.png" alt=""></div>
        </div>
    </div>
    @show
</header>
