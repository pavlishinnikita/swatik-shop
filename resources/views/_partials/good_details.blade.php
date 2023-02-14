<div class="good-modal__logo">
    <img src="/images/pay-window/earth.png" alt="">
</div>
<div class="good-modal">
    <div class="good-modal__header">
        <img src="{{$item['image'] ?? ''}}" alt="">
        <h1>{{$item['name'] ?? ''}}</h1>
    </div>
    <div class="good-modal__body">
        <div class="inputs-group">
            <label for="">Ваш никнейм</label>
            <input type="text" placeholder="Введите ник">
        </div>
        <div class="buttons-group">
            <div class="info">*ввести промкод*</div>
            <button>Оплатить {{$item['price'] ?? ''}}</button>
        </div>
    </div>
    <div class="good-modal__footer">
        <div class="info">После оплаты напишите нам в ВК</div>
    </div>
</div>
