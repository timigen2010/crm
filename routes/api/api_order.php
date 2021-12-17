<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function() {
    Route::post('/new', 'Api\Order\OrderController@createAction')
        ->name('orders_new');

    Route::put('/{order}/edit', 'Api\Order\OrderController@editAction')
        ->name('orders_edit');

    Route::post('/{order}/change_status', 'Api\Order\OrderController@changeStatusAction')
        ->name('order_change_status');

    Route::get('', 'Api\Order\OrderController@getOrdersAction')
        ->name('orders');

    Route::get('/{order}/show', 'Api\Order\OrderController@getShowAction')
        ->name('orders_show');
});



