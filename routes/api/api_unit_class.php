<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'unit_classes'], function() {
    Route::post('/new', 'Api\Unit\UnitClassController@createAction')
        ->name('unit_classes_new');

    Route::put('/edit/{unitClass}', 'Api\Unit\UnitClassController@editAction')
        ->name('unit_classes_edit');

    Route::delete('/delete/{unitClass}', 'Api\Unit\UnitClassController@deleteAction')
        ->name('unit_classes_delete');

    Route::get('', 'Api\Unit\UnitClassController@getUnitsAction')
        ->name('unit_classes');

    Route::get('/show/{unitClass}', 'Api\Unit\UnitClassController@getShowAction')
        ->name('unit_classes_show');
});



