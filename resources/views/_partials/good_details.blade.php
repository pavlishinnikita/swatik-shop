<div class="good-modal__logo">
    <img src="/images/pay-window/earth.png" alt="">
</div>
<div class="good-modal">
    <div class="good-modal__header">
        <img src="{{$item['image'] ?? ''}}" alt="">
        <h1>{{$item['name'] ?? ''}}</h1>
    </div>
    <div class="good-modal__body">
        <form action="/test" method="post" data-form="good">
            <div id="details-info" class="">
                <div class="inputs-group">
                    <label for="">Ваш никнейм</label>
                    <input name="nickname" type="text" placeholder="Введите ник">
                    <div class="error"></div>
                </div>
                <div class="buttons-group">
                    <div class="info">*ввести промкод*</div>
                    <button>Оплатить {{$item['price'] ?? ''}}</button>
                </div>
            </div>
            <div id="payment-info" class="hidden">
                @include('/_partials/good_payment')
                <div class="inputs-group">
                    <label for="">Введите ел. почту</label>
                    <input name="email" type="email" placeholder="astrosea@gmail.com">
                    <div class="error"></div>
                </div>
            </div>
            <input name="payment" type="hidden" value="">
            <input name="step" type="hidden" value="1">
            @csrf
        </form>
    </div>
    <div class="good-modal__footer">
        <div class="info">После оплаты напишите нам в ВК</div>
    </div>
</div>
