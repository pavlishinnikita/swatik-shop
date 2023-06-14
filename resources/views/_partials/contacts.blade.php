<?php
use App\Constants\GoodBuyingProcessConstant;use App\Models\Good;use App\Models\GoodCategory;
?>
<div class="good-modal__logo">
    <img src="/images/pay-window/earth.png" alt="">
</div>
<div class="good-modal">
    <div class="good-modal__header">
        Контакты
    </div>
    <div class="good-modal__body">
        <div class="contacts-wrapper">
            <div class="contact-item">
                <img src="/images/contacts/gmail.png" alt="Gmail">
                <p><a href="mailto:{{env('APP_MAIL_ADDRESS')}}">{{env('APP_MAIL_ADDRESS')}}</a></p>
            </div>
            <div class="contact-item">
                <img src="/images/contacts/vk.png" alt="VK">
                <p><a href="{{env('APP_VK_LINK')}}">{{env('APP_VK_LINK')}}</a></p>
            </div>
        </div>
    </div>
    <div class="good-modal__footer"></div>
</div>
