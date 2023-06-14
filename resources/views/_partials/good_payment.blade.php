<?php
use App\Models\Payment;
?>
<div class="inputs-group">
    <label for="">Выберите способ оплаты</label>
    <div class="cards">
        <div data-paymentMethod="<?= Payment::PAYMENT_METHOD_MC ?>" data-paymentType="<?= Payment::PAYMENT_TYPE_OTHER ?>"><img src="/images/pay-window/visa-mc.png" alt=""></div>
        <div data-paymentMethod="<?= Payment::PAYMENT_METHOD_WORLD ?>" data-paymentType="<?= Payment::PAYMENT_TYPE_OTHER ?>"><img src="/images/pay-window/mir.png" alt=""></div>
        <div data-paymentMethod="<?= Payment::PAYMENT_METHOD_MTC ?>" data-paymentType="<?= Payment::PAYMENT_TYPE_OTHER ?>"><img src="/images/pay-window/io.png" alt=""></div>
        <div data-paymentMethod="<?= Payment::PAYMENT_METHOD_QIWI ?>" data-paymentType="<?= Payment::PAYMENT_TYPE_OTHER ?>"><img src="/images/pay-window/qiwi.png" alt=""></div>
    </div>
</div>
<div class="inputs-group">
    <label id="payment-for-ua">Для украинцев</label>
    <div class="cards">
        <div data-paymentMethod="<?= Payment::PAYMENT_METHOD_VISA ?>" data-paymentType="<?= Payment::PAYMENT_TYPE_UA ?>"><img src="/images/pay-window/visa-mc_ua.png" alt=""></div>
    </div>
</div>
