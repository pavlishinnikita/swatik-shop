<?php
use App\Constants\GoodBuyingProcessConstant;
use App\Models\Good;
use App\Models\GoodCategory;
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
                    <div class="inputs-group">
                        <div class="radio-group">
                            @foreach($item['subscribeDurations'] as $key => $subscribeItem)
                                <input data-change-handler="subscriptionChange" <?= $key == 0 ? 'checked' : ''?> data-price="{{$subscribeItem['pivot']['price']}}" id="duration_{{$key}}" type="radio" value="{{$subscribeItem['value']}}" name="duration">
                                <label for="duration_{{$key}}">{{$subscribeItem['label']}}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="buttons-group">
                        <div class="info hidden">*ввести промкод*</div>
                        @if(empty($item['subscribeDurations']['items']))
                            <button>Оплатить <span data-id="total_price">{{$item['price']}}</span><span class="currency-sign">{!! env('CURRENCY_SIGN') !!}</span></button>
                        @else
                            <button>Оплатить <span data-id="total_price">0</span><span class="currency-sign">{!! env('CURRENCY_SIGN') !!}</span></button>
                        @endif
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
        <div class="info"><?= ($item['need_human_action'] ?? 0) == 1 ? 'После оплаты напишите нам в ВК' : ''?></div>
        <div class="info"><a href="" data-back-to="">Назад</a></div>
    </div>
</div>
