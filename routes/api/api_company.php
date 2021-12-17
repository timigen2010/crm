<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'companies'], function() {
    Route::post('/new', 'Api\Company\CompanyController@createAction')
        ->name('companies_new');

    Route::put('/edit/{company}', 'Api\Company\CompanyController@editAction')
        ->name('companies_edit');

    Route::delete('/delete/{company}', 'Api\Company\CompanyController@deleteAction')
        ->name('companies_delete');

    Route::get('', 'Api\Company\CompanyController@getCompaniesAction')
        ->name('companies');

    Route::get('/show/{company}', 'Api\Company\CompanyController@getShowAction')
        ->name('companies_show');

    Route::get('/{company}/settings/{key}', 'Api\Company\CompanySettingController@getSettingByKeyAction')
        ->name('company_settings_by_key');

    Route::get('/show_by_url/{company:url}', 'Api\Company\CompanyController@getByUrlAction')
        ->name('companies_show_by_url');
});



