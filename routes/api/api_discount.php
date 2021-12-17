<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'discounts'], function() {
    Route::get('/operations/history', 'Api\Discount\DiscountController@getHistoryOperationsAction')
        ->name('discount_operations_history');

    Route::post('/released_cards/release_mass', 'Api\Discount\DiscountController@releaseMassFreeCardsAction')
        ->name('discount_released_cards_release_mass');

    Route::post('/cards/send_request_activate', 'Api\Discount\DiscountController@sendRequestActivateAction')
        ->name('discount_cards_send_request_activate');

    Route::post('/cards/activate', 'Api\Discount\DiscountController@activateCardAction')
        ->name('discount_cards_activate');

    Route::post('/cards/deactivate', 'Api\Discount\DiscountController@deactivateCardAction')
        ->name('discount_cards_deactivate');

    Route::post('/cards/get_balance', 'Api\Discount\DiscountController@getBalanceCardAction')
        ->name('discount_cards_get_balance');

    Route::post('/cards/get_card_by_customer', 'Api\Discount\DiscountController@getBalanceCardByCustomerAction')
        ->name('discount_cards_get_card_by_customer');

    Route::post('/cards/balance_replenishment', 'Api\Discount\DiscountController@replenishmentBalanceCardAction')
        ->name('discount_cards_balance_replenishment');

    Route::post('/cards/rebind', 'Api\Discount\DiscountController@rebindCardAction')
        ->name('discount_cards_rebind');
});
