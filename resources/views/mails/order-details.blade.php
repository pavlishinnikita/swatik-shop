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
            <td class="good-name">{{$good['name']}}:</td>
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
