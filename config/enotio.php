<?php


return [

    /*
     * Project`s id
     */
    'project_id' => env('ENOT_MERCHANT_ID', ''),

    /*
     * First project`s secret key
     */
    'secret_key' => env('ENOT_SECRET_FIRST', ''),

    /*
     * Second project`s secret key
     */
    'secret_key_second' => env('ENOT_SECRET_SECOND', ''),

    /*
     * Allowed currenc'ies https://enot.io/knowledge/first-payment#pay_form
     *
     * If currency = null, that parameter doesn`t be setted
     */
    'currency' => \App\Services\Payment\EnotPaymentService::CURRENCY_RUB,

    /*
     *  SearchOrder
     *  Search order in the database and return order details
     *  Must return array with:
     *
     *  _orderStatus
     *  _orderSum
     */
    'searchOrder' => 'App\Http\Controllers\EnotController@searchOrder',

    /*
     *  PaidOrder
     *  If current _orderStatus from DB != paid then call PaidOrderFilter
     *  update order into DB & other actions
     */
    'paidOrder' => 'App\Http\Controllers\EnotController@paidOrder',

    /*
     * Customize error messages
     */
    'errors' => [
        'validateOrderFromHandle' => 'Ошибка проверки заказа',
        'searchOrder' => 'Заказ не найден',
        'paidOrder' => 'Ошибка оплаты заказа',
    ],

    /*
     * Url to init payment on EnotIo
     * https://enot.io/knowledge/first-payment#pay_form
     */
    'pay_url' => 'https://enot.io/pay',

    /*
     * URL where to redirect the user after successful payment.
     * (If empty, the value is taken from the store settings.
     *  This parameter is in priority for redirection)
     */
    'success_url' => 'https://astrosea.fun/congratulation',
    /*
     * URL where to redirect the user after error payment.
     * (If empty, the value is taken from the store settings.
     *  This parameter is in priority for redirection)
     */
    'fail_url' => 'https://astrosea.fun/error',
];
