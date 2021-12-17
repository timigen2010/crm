<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'foreign'], function() {

    Route::group(['prefix' => 'products'], function() {
        Route::post('/cpfc', 'Api\Product\ForeignProductCPFCController@getByIdsAction')
            ->name('foreign_products_cpfc_get');

        Route::get('/{product}/cpfc', 'Api\Product\ForeignProductCPFCController@getAction')
            ->name('foreign_product_cpfc_get');
    });
});



