<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'menus'], function() {
    Route::post('/new', 'Api\Menu\MenuController@createAction')
        ->name('menus_new');

    Route::put('/edit/{menu}', 'Api\Menu\MenuController@editAction')
        ->name('menus_edit');

    Route::delete('/delete/{menu}', 'Api\Menu\MenuController@deleteAction')
        ->name('menus_delete');

    Route::get('', 'Api\Menu\MenuController@getMenusAction')
        ->name('menus');

    Route::get('/show/{menu}', 'Api\Menu\MenuController@getShowAction')
        ->name('menus_show');
});



