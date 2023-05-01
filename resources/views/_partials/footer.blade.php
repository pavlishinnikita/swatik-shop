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
                <a href="mailto:{{env('MAIL_FROM_BCC_ADDRESS')}}">{{env('MAIL_FROM_BCC_ADDRESS')}}</a>
            </p>
        </div>
        <div class="links">
            <a href="<?= URL::to('/privacy/pdf');?>" target="_blank">Политика конфиденциальности</a>
            <a href="">Соглашение об обработке персональных данных</a>
        </div>
    @show
</footer>
