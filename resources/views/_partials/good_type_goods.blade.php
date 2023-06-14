<?php
use App\Models\Good;
?>
<div class="good-modal__logo full">
    <div class="good-type-name">{{ $item['name'] ?? '' }}</div>
    <img src="/images/pay-window/goods_logo.png" alt="">
</div>
<div class="good-modal good-type">
    <div class="good-modal__header"></div>
    <div class="good-modal__body">
        <div class="goods">
            @foreach($item['goods'] as $good)
                <div class="good-wrapper <?= ($good['type'] ?? '') == Good::TYPE_PRIVILEGE ? 'privilege' : ''?>" data-type="{{ $good['type'] ?? ''}}" data-id="{{ $good['id'] ?? '' }}">
                    @if(isset($good['label']))
                        <span class="label">{{$good['label']}}</span>
                    @endif
                    <img src="{{ $good['image'] ?? '' }}" alt="">
                    <span class="good-name <?= ($goodType ?? '') == Good::TYPE_PRIVILEGE ? 'colored' : ''?>">{{ $good['name'] ?? '' }}</span>
                        @if($good['subscribeDurations']->isEmpty())
                            <span class="good-price">{{ $good['price'] ?? '' }}</span>
                        @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="good-modal__footer"></div>
</div>
