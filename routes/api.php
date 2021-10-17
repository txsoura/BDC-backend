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
Route::group(['prefix' => 'v1'], function () {
# Version
    Route::get('/', function () {
        return [
            'name' => config('app.name'),
            'version' => config('app.version'),
            'locale' => app()->getLocale(),
        ];
    });

    Route::apiResource('users', 'UserController');
    Route::put('users/{user}/approve', 'UserController@approve')->name('users.approve');
    Route::put('users/{user}/block', 'UserController@block')->name('users.block');

    Route::apiResource('constructions', 'ConstructionController');
    Route::put('constructions/{construction}/cancel', 'ConstructionController@cancel')->name('constructions.cancel');
    Route::put('constructions/{construction}/start', 'ConstructionController@start')->name('constructions.start');
    Route::put('constructions/{construction}/pause', 'ConstructionController@pause')->name('constructions.pause');
    Route::put('constructions/{construction}/abandon', 'ConstructionController@abandon')->name('constructions.abandon');
    Route::put('constructions/{construction}/finalize', 'ConstructionController@finalize')->name('constructions.finalize');

    Route::group(['prefix' => 'constructions/{construction}'], function () {
        Route::apiResource('users', 'ConstructionUserController');
        Route::apiResource('stages', 'StageController');
        Route::apiResource('inspections', 'InspectionController');

        Route::apiResource('providers', 'ProviderController');
        Route::apiResource('products', 'ProductController');

        Route::group(['prefix' => 'products/{product}'], function () {
            Route::apiResource('stocks', 'StockController')->except('update');
            Route::put('stocks/{stock}/cancel', 'StockController@cancel')->name('stocks.cancel');
            Route::put('stocks/{stock}/arrive', 'StockController@arrive')->name('stocks.arrive');
            Route::put('stocks/{stock}/outgoing', 'StockController@outgoing')->name('stocks.outgoing');
        });
    });
});

