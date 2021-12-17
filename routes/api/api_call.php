<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'calls'], function() {
    Route::group(['prefix' => 'dial_statuses'], function() {
        Route::post('/new', 'Api\Unit\UnitClassController@createAction')
            ->name('dial_statuses_new');

        Route::put('/edit/{unitClass}', 'Api\Unit\UnitClassController@editAction')
            ->name('dial_statuses_edit');

        Route::delete('/delete/{unitClass}', 'Api\Unit\UnitClassController@deleteAction')
            ->name('dial_statuses_delete');

        Route::get('', 'Api\Unit\UnitClassController@getUnitsAction')
            ->name('dial_statuses');

        Route::get('/show/{unitClass}', 'Api\Unit\UnitClassController@getShowAction')
            ->name('dial_statuses_show');
    });
});
