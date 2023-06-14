<?php
use Illuminate\Support\Facades\URL;
?>
<footer>
    @section('footer')
        <div class="block-wrapper">
            <div class="footer-block">
                <div class="cards">
                    <img src="/images/footer/mc.png" alt="">
                    <img src="/images/footer/visa.png" alt="">
                    <img src="/images/footer/mir.png" alt="">
                </div>
                <div class="owner-info">
                    <div class="info-item">{{env('OWNER_NAME')}}</div>
                    <div class="info-item">НОМЕР {{env('OWNER_CARD')}}</div>
                </div>
            </div>
            <div class="footer-block">
                <div class="info">На странице информации о карте вам будет предложено ввести номер карты, имя владельца карты, срок действия карты и трехзначный код безопасности (CVV2 для Visa и CVC2 для MasterCard)</div>
            </div>
            <div class="footer-block">
                <div class="links">
                    <div>
                        <a href="<?= URL::to('/privacy/pdf');?>" target="_blank">Политика конфиденциальности</a>
                        <a href="<?= URL::to('/contract/pdf');?>" target="_blank">Договор оферты</a>
                    </div>
                    <div>
                        <a href="" easy-class="show" easy-toggle="#securityPolicyModal">Политика безопасности и возврата</a>
                        <a href="" easy-class="show" easy-toggle="#contactsModal">Контакты</a>
                    </div>
                </div>
            </div>
        </div>
    @show
</footer>
