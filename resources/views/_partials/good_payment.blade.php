<div class="good-modal">
    <div class="good-modal__logo">
        <img src="/images/pay-window/earth.png" alt="">
    </div>
    <div class="good-modal__header">
        <h1>{{$goodName ?? ''}}</h1>
    </div>
    <div class="good-modal__body">
        <div class="inputs-group">
            <label for="">Выберите способ оплаты</label>
            <div class="cards">
                <img src="/images/pay-window/visa.png" alt="">
                <img src="/images/pay-window/mc.png" alt="">
                <img src="/images/pay-window/peace.png" alt="">
                <img src="/images/pay-window/mtc.png" alt="">
                <img src="/images/pay-window/qiwi.png" alt="">
            </div>
        </div>
        <div class="inputs-group">
            <label id="payment-for-ua">Для украинцев</label>
            <div class="cards">
                <img src="/images/pay-window/visa_ua.png" alt="">
                <img src="/images/pay-window/mc_ua.png" alt="">
            </div>
        </div>
        <div class="inputs-group">
            <label for="">Введите ел. почту</label>
            <input type="email" placeholder="astrosea@gmail.com">
        </div>
    </div>
    <div class="good-modal__footer">
        <div class="info">Вернутся назад</div>
    </div>
</div>
