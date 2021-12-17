<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'couriers'], function() {
    Route::get('/by_company/{company}', 'Api\Courier\CourierController@getByCompanyAction')
        ->name('couriers_by_company');
});



