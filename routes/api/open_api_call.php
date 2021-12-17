<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'calls'], function() {
    Route::post('/set_event', 'OpenApi\Call\SetCallEventController@setCallEventAction')
        ->name('set_call_event');
});

