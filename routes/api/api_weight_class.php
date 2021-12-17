<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'weight_classes'], function() {
    Route::post('/new', 'Api\Weight\WeightClassController@createAction')
        ->name('weight_classes_new');

    Route::put('/{weightClass}/edit', 'Api\Weight\WeightClassController@editAction')
        ->name('weight_classes_edit');

    Route::delete('/{weightClass}/delete', 'Api\Weight\WeightClassController@deleteAction')
        ->name('weight_classes_delete');

    Route::get('', 'Api\Weight\WeightClassController@getWeightsAction')
        ->name('weight_classes');

    Route::get('/{weightClass}/show', 'Api\Weight\WeightClassController@getShowAction')
        ->name('weight_classes_show');

    Route::post('/{weightClass}/rebind', 'Api\Weight\WeightClassController@rebindAction')
        ->name('rebind_classes_show');
});



