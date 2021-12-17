<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'languages'], function() {
    Route::post('/new', 'Api\Language\LanguageController@createAction')
        ->name('languages_new');

    Route::put('/{language}/edit', 'Api\Language\LanguageController@editAction')
        ->name('languages_edit');

    Route::delete('/{language}/delete', 'Api\Language\LanguageController@deleteAction')
        ->name('languages_delete');

    Route::get('', 'Api\Language\LanguageController@getLanguagesAction')
        ->name('languages');

    Route::get('/{language}/show', 'Api\Language\LanguageController@getShowAction')
        ->name('languages_show');

    Route::post('/images/upload', 'Api\Language\LanguageController@uploadImageAction')
        ->name('languages_images_upload');

    Route::post('/images/delete', 'Api\Language\LanguageController@deleteImageAction')
        ->name('languages_images_delete');
});



