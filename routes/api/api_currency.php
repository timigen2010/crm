<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'currencies'], function() {
    Route::post('/new', 'Api\Currency\CurrencyController@createAction')
        ->name('currencies_new');

    Route::put('/{currency}/edit', 'Api\Currency\CurrencyController@editAction')
        ->name('currencies_edit');

    Route::delete('/{currency}/delete', 'Api\Currency\CurrencyController@deleteAction')
        ->name('currencies_delete');

    Route::get('', 'Api\Currency\CurrencyController@getCurrenciesAction')
        ->name('currencies');

    Route::get('/{currency}/show', 'Api\Currency\CurrencyController@getShowAction')
        ->name('currencies_show');

    Route::post('/{currency}/rebind', 'Api\Currency\CurrencyController@rebindAction')
        ->name('currencies_rebind');

    Route::post('/refresh_exchange_rate', 'Api\Currency\CurrencyController@refreshExchangeRateAction')
        ->name('currencies_refresh_exchange_rate');
});



