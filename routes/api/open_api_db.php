<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'db'], function() {
    Route::post('/sync', 'OpenApi\DB\DBSyncController@dbSyncAction')
        ->name('db_sync');
});

