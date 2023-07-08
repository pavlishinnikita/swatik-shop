<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/category/all-good-categories', 'CategoryController');
    $router->resource('/good/all-goods', 'GoodController');
    $router->resource('/commands/all-commands', 'CommandController');
    $router->resource('/order/all-orders', 'OrderController');
    $router->resource('/subscriptions', 'SubscriptionDurationController');
});
