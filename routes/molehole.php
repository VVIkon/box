<?php


/**
 *  Кторовая нора для API
 * RouteServiceProvider->mapApiRoutes()
 *
 * /molehole/store/product/2
 */

use Illuminate\Http\Request;

Route::group(['prefix'=>'store'], function() {
    Route::get('/classificator', ['as' => 'store.classificator', 'uses' => 'Store\StoreController@loadClassificator',]);
    Route::get('/category', ['as' => 'store.category', 'uses' => 'Store\StoreController@getCategory',]);
    Route::get('/product/{id}', ['as' => 'store.product', 'uses' => 'Store\StoreController@getProductList',]);
    Route::post('/addclient', ['as' => 'store.client.add', 'uses' => 'Store\StoreController@addClient',]);
});