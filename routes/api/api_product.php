<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'products'], function() {
    Route::post('/new', 'Api\Product\ProductController@createAction')
        ->name('products_new');

    Route::put('/edit/{product}', 'Api\Product\ProductController@editAction')
        ->name('products_edit');

    Route::delete('/delete/{product}', 'Api\Product\ProductController@deleteAction')
        ->name('products_delete');

    Route::get('', 'Api\Product\ProductController@getProductsAction')
        ->name('products');

    Route::get('/by_menu/{menu}', 'Api\Product\ProductMenuController@getProductsByMenuAction')
        ->name('products_by_menu');

    Route::post('/by_categories', 'Api\Product\ProductController@getProductsByCategoriesAction')
        ->name('products_by_categories');

    Route::get('/types', 'Api\Product\ProductTypeController@getProductTypesAction')
        ->name('product_types');

    Route::get('/show/{product}', 'Api\Product\ProductController@getShowAction')
        ->name('products_show');

    Route::post('/{product}/images/upload', 'Api\Product\ProductImageController@uploadImageAction')
        ->name('products_images_upload');

    Route::delete('/images/{productImage}/delete', 'Api\Product\ProductImageController@deleteImageAction')
        ->name('products_images_delete');

    Route::post('/cpfc', 'Api\Product\ProductCPFCController@getByIdsAction')
        ->name('products_cpfc_get');

    Route::get('/{product}/cpfc', 'Api\Product\ProductCPFCController@getAction')
        ->name('product_cpfc_get');

    Route::post('/{product}/cpfc/edit', 'Api\Product\ProductCPFCController@editAction')
        ->name('product_cpfc_edit');


});



