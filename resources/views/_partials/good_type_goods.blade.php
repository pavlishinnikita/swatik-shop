<?php
use App\Models\Good;
?>
<div class="good-modal__logo full">
    <img src="/images/pay-window/goods_logo.png" alt="">
</div>
<div class="good-type-name">{{ $item['name'] ?? '' }}</div>
<div class="good-modal good-type">
    <div class="good-modal__header"></div>
    <div class="good-modal__body">
        <div class="goods">
            @foreach($item['goods'] as $good)
                <div class="good-wrapper <?= ($goodType ?? '') == Good::TYPE_PRIVILEGE ? 'privilege' : ''?>">
                    <img src="{{ $good['image'] ?? '' }}" alt="">
                    <span class="good-name <?= ($goodType ?? '') == Good::TYPE_PRIVILEGE ? 'colored' : ''?>">{{ $good['name'] ?? '' }}</span>
                    <span class="good-price">{{ $good['price'] ?? '' }}</span>
                </div>
            @endforeach
        </div>
    </div>
    <div class="good-modal__footer"></div>
</div>
