@extends('layouts.mail')
<style>
    .goods, .greeting, .instructions {
        font-weight: bold;
    }
    .greeting {
        text-align: center;
    }
</style>
@section('body')
    <tr>
        <td colspan="2">
            <div class="greeting">
                {{$order->details['nickname'] ?? ''}}, спасибо за покупку!
                <div>Ваш заказ:</div>
            </div>
        </td>
    </tr>
    @foreach($order['goods'] as $good)
        <tr class="goods">
            @if (array_key_exists( 'duration', $order->details) && !empty($good['subscribeDurations']->firstWhere('value', '=', $order->details['duration'])))
                <td class="good-name">{{$good['name']}} ({{$good['subscribeDurations']->firstWhere('value', '=', $order->details['duration'])['label']}}):</td>
            @else
                <td class="good-name">{{$good['name']}}:</td>
            @endif
            <td class="good-count">{{$good['pivot']['count']}}</td>
        </tr>
    @endforeach
    <tr>
        <td>Сумма:</td>
        <td>{{$order['price']}}  {!! env('CURRENCY_SIGN') !!}</td>
    </tr>
@endsection

@section('footer')
    <tr>
        <td colspan="3">
            <p class="instructions">Ждём на сервере, ваш заказ активен!</p>
        </td>
    </tr>
@endsection
