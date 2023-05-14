<?php
use Illuminate\Support\Facades\URL;
?>
<footer>
    @section('footer')
        <div class="info">
            <p>
                <span class="en-text">Copyright © {{config('app.appName')}} <?= date('Y') ?>. </span>Все права защищены.
            </p>
            <p>
                Сервер никак не относится к <span class="en-text">Mojang, AB.</span>
            </p>
            <p>
                Для получения дополнительной информации и помощи, обратитесь по адресу
            </p>
            <p class="en-text">
                <a href="mailto:{{env('APP_MAIL_ADDRESS')}}">{{env('APP_MAIL_ADDRESS')}}</a>
            </p>
        </div>
        <div class="links">
            <a href="<?= URL::to('/privacy/pdf');?>" target="_blank">Политика конфиденциальности</a>
            <a href="" easy-class="show" easy-toggle="#securityPolicyModal">Политика безопасности и возврата</a>
        </div>
    @show
</footer>
