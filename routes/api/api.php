<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'users'], function() {
    Route::post('/register', 'Api\User\UserController@registerUserAction')
        ->name('users_register');

    Route::put('edit/{user}', 'Api\User\UserController@editAction')
        ->name('users_edit');

    Route::delete('/delete/{user}', 'Api\User\UserController@deleteAction')
        ->name('users_delete');

    Route::get('', 'Api\User\UserController@getUsersAction')
        ->name('users');

    Route::get('show/{user}', 'Api\User\UserController@getShowAction')
        ->name('users_show');

    Route::post('change_password', 'Api\User\UserController@changePasswordAction')
        ->name('users_change_password');

    Route::post('avatar/{user}', 'Api\User\UserController@uploadAvatarAction')
        ->name('users_avatar');
});

Route::group(['prefix' => 'user_permissions'], function() {
    Route::post('/new', 'Api\User\PermissionController@createAction')
        ->name('user_permissions_new');

    Route::put('/edit/{permission}', 'Api\User\PermissionController@editAction')
        ->name('user_permissions_edit');

    Route::delete('/delete/{permission}', 'Api\User\PermissionController@deleteAction')
        ->name('user_permissions_delete');

    Route::get('', 'Api\User\PermissionController@getPermissionsAction')
        ->name('user_permissions');

    Route::get('/by_auth_user', 'Api\User\PermissionController@getAuthUserPermissionsAction')
        ->name('auth_user_permissions');

    Route::get('/show/{permission}', 'Api\User\PermissionController@showAction')
        ->name('user_permissions_show');
});

Route::group(['prefix' => 'user_groups'], function() {
    Route::post('/new', 'Api\User\UserGroupController@createAction')
        ->name('user_groups_new');

    Route::put('/edit/{userGroup}', 'Api\User\UserGroupController@editAction')
        ->name('user_groups_edit');

    Route::delete('/delete/{userGroup}', 'Api\User\UserGroupController@deleteAction')
        ->name('user_groups_delete');

    Route::get('', 'Api\User\UserGroupController@getUserGroupsAction')
        ->name('user_groups');

    Route::get('/show/{userGroup}', 'Api\User\UserGroupController@showAction')
        ->name('user_groups_show');
});

Route::group(['prefix' => 'companies'], function() {
    Route::group(['prefix' => 'phonelines'], function() {
        Route::post('/new', 'Api\Company\CompanyPhonelineController@createAction')
            ->name('company_phonelines_new');

        Route::put('/edit/{companyPhoneline}', 'Api\Company\CompanyPhonelineController@editAction')
            ->name('company_phonelines_edit');

        Route::delete('/delete/{companyPhoneline}', 'Api\Company\CompanyPhonelineController@deleteAction')
            ->name('company_phonelines_delete');

        Route::get('', 'Api\Company\CompanyPhonelineController@getCompanyPhonelinesAction')
            ->name('company_phonelines');

        Route::get('/show/{companyPhoneline}', 'Api\Company\CompanyPhonelineController@getShowAction')
            ->name('company_phonelines_show');
    });
});

Route::group(['prefix' => 'calls/activities'], function() {
    Route::post('/new', 'Api\Call\CallActivityController@createAction')
        ->name('call_activities_new');

    Route::put('/edit/{callActivity}', 'Api\Call\CallActivityController@editAction')
        ->name('call_activities_edit');

    Route::get('', 'Api\Call\CallActivityController@getCallsAction')
        ->name('call_activities');

    Route::get('/show/{callActivity}', 'Api\Call\CallActivityController@getShowAction')
        ->name('call_activities_show');
});

Route::post('calls/check_call', 'Api\Call\CallActivityController@checkCallAction')
    ->name('check_call');

Route::group(['prefix' => 'categories'], function() {
    Route::group(['prefix' => 'badges'], function() {
        Route::post('/new', 'Api\Category\CategoryBadgeController@createAction')
            ->name('category_badges_new');

        Route::put('/edit/{badge}', 'Api\Category\CategoryBadgeController@editAction')
            ->name('category_badges_edit');

        Route::delete('/delete/{badge}', 'Api\Category\CategoryBadgeController@deleteAction')
            ->name('category_badges_delete');

        Route::get('', 'Api\Category\CategoryBadgeController@getBadgesAction')
            ->name('category_badges');

        Route::get('/show/{badge}', 'Api\Category\CategoryBadgeController@getShowAction')
            ->name('category_badges_show');

        Route::post('/images/upload', 'Api\Category\CategoryBadgeController@uploadImageAction')
            ->name('category_badges_images_upload');

        Route::post('/images/delete', 'Api\Category\CategoryBadgeController@deleteImageAction')
            ->name('category_badges_images_delete');
    });

    Route::post('/new', 'Api\Category\CategoryController@createAction')
        ->name('categories_new');

    Route::put('/edit/{category}', 'Api\Category\CategoryController@editAction')
        ->name('categories_edit');

    Route::delete('/delete/{category}', 'Api\Category\CategoryController@deleteAction')
        ->name('categories_delete');

    Route::get('', 'Api\Category\CategoryController@getCategoriesAction')
        ->name('categories');

    Route::get('/by_menu/{menu}', 'Api\Category\CategoryMenuController@getCategoriesByMenuAction')
        ->name('categories_by_menu');

    Route::get('/show/{category}', 'Api\Category\CategoryController@getShowAction')
        ->name('categories_show');

    Route::post('/{category}/images/upload', 'Api\Category\CategoryImageController@uploadImageAction')
        ->name('categories_images_upload');

    Route::delete('/images/{categoryImage}/delete', 'Api\Category\CategoryImageController@deleteImageAction')
        ->name('categories_images_delete');
});


Route::get('/directories', 'Api\DirectoryController@getDirectoriesAction')
    ->name('get_directories');


