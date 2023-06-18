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
                <a target="_blank" href="mailto:{{env('APP_MAIL_ADDRESS')}}"></a>
                <img src="/images/contacts/gmail.png" alt="Gmail">
                <span>{{env('APP_MAIL_ADDRESS')}}</span>
            </div>
            <div class="contact-item">
                <a target="_blank" href="{{env('APP_VK_LINK')}}"></a>
                <img src="/images/contacts/vk.png" alt="VK">
                <span>{{str_replace('https://', '', env('APP_VK_LINK'))}}</span>
            </div>
        </div>
    </div>
    <div class="good-modal__footer"></div>
</div>
