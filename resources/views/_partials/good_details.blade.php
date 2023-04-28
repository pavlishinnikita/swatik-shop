<?php
use App\Constants\GoodBuyingProcessConstant;use App\Models\GoodCategory;
?>
<div class="good-modal__logo">
    <img src="/images/pay-window/earth.png" alt="">
</div>
<div class="good-modal">
    <div class="good-modal__header">
        <img src="{{$item['image'] ?? ''}}" alt="">
        <h1>{{$item['name'] ?? ''}}</h1>
    </div>
    <div class="good-modal__body">
        <form action="" method="post" data-form="good">
            <div id="details-info" class="" data-step="<?= GoodBuyingProcessConstant::STEP_GOOD_DETAILS?>">
                <div class="inputs-group">
                    <label for="">Ваш никнейм</label>
                    <input name="nickname" type="text" placeholder="Введите ник">
                    <div class="error"></div>
                </div>
                <?php if($goodCategoryType === GoodCategory::TYPE_COUNTABLE):?>
                    <div class="inputs-group">
                        <label for="">Колличество</label>
                        <input id="good_count" name="count" type="text" placeholder="Введите количество" data-price-one="{{$item['price']}}">
                        <div class="error"></div>
                    </div>
                    <div class="inputs-group">
                        <label for="">Цена одной ракушки: {{$item['price'] ?? ''}}</label>
                    </div>
                    <div class="buttons-group">
                        <div class="info hidden">*ввести промкод*</div>
                        <button>Оплатить <span id="total_price">0</span><span class="currency-sign">{!! env('CURRENCY_SIGN') !!}</span></button>
                    </div>
                <?php else:?>
                    <div class="buttons-group">
                        <div class="info hidden">*ввести промкод*</div>
                        <button>Оплатить {{$item['price'] ?? ''}} <span class="currency-sign">{!! env('CURRENCY_SIGN') !!}</span> </button>
                    </div>
                <?php endif;?>
            </div>
            <div id="payment-info" class="hidden" data-step="<?= GoodBuyingProcessConstant::STEP_CHOOSE_PAYMENT?>">
                @include('/_partials/good_payment')
                <div class="inputs-group">
                    <label for="">Введите ел. почту</label>
                    <input name="email" type="email" placeholder="astrosea@gmail.com">
                    <div class="error"></div>
                </div>
            </div>
            <input name="paymentMethod" type="hidden" value="">
            <input name="paymentType" type="hidden" value="">
            <input name="step" type="hidden" value="1">
            <input name="categoryType" type="hidden" value="<?=$goodCategoryType?>">
            <input name="good_id" type="hidden" value="{{$item['id'] ?? 0}}">
            @csrf
        </form>
    </div>
    <div class="good-modal__footer">
        <div class="info">После оплаты напишите нам в ВК</div>
        <div class="info"><a href="" data-back-to="">Назад</a></div>
    </div>
</div>
