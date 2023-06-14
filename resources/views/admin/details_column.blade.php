<div>
    <span><b>Nickname: </b></span><span>{{$value['nickname']}}</span>
</div>
<div>
    <span><b>Email: </b></span><span>{{$value['email']}}</span>
</div>
<div>
    <span><b>Тип платежа: </b></span><span>{{\App\Models\Payment::PAYMENT_TYPES[$value['paymentType']] ?? 'Неправильный тип'}}</span>
</div>
<div>
    <span><b>Платежный метод: </b></span><span>{{\App\Models\Payment::PAYMENT_METHODS[$value['paymentMethod']] ?? 'Неправильный метод'}}</span>
</div>
