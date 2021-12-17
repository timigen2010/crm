<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reports'], function() {

    Route::get('product_complects', 'Api\Report\ProductComplect\ProductComplectController@getProductComplectsAction')
        ->name('product_complects');
});



