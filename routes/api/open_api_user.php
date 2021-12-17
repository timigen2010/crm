<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function() {
    Route::post('/reset_password', 'OpenApi\User\UserController@resetPasswordAction')
        ->name('users_reset_password');

    Route::post('/recovery_password', 'OpenApi\User\UserController@recoveryPasswordAction')
        ->name('users_recovery_password');
});
