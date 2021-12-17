<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'customers'], function() {
    Route::post('/new', 'Api\Customer\CustomerController@createAction')
        ->name('customers_new');

    Route::put('/edit/{customer}', 'Api\Customer\CustomerController@editAction')
        ->name('customers_edit');

    Route::get('', 'Api\Customer\CustomerController@getCustomersAction')
        ->name('customers');

    Route::get('/show/{customer}', 'Api\Customer\CustomerController@getShowAction')
        ->name('customers_show');

    Route::get('/last_order/{customer}', 'Api\Customer\CustomerController@getLastOrderAction')
        ->name('last_order_by_customer');

    Route::group(['prefix' => 'groups'], function() {
        Route::post('/new', 'Api\Customer\CustomerGroupController@createAction')
            ->name('customer_groups_new');

        Route::put('/edit/{customerGroup}', 'Api\Customer\CustomerGroupController@editAction')
            ->name('customer_groups_edit');

        Route::delete('/delete/{customerGroup}', 'Api\Customer\CustomerGroupController@deleteAction')
            ->name('customer_groups_delete');

        Route::get('', 'Api\Customer\CustomerGroupController@getCustomerGroupsAction')
            ->name('customer_groups');

        Route::get('/show/{customerGroup}', 'Api\Customer\CustomerGroupController@getShowAction')
            ->name('customer_groups_show');
    });

    Route::get('/find_telephones', 'Api\Customer\CustomerTelephoneController@findTelephonesAction')
        ->name('customer_telephones');
});
