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

    Route::post('company/register', 'CompanyController@store')->name('companies.register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', 'UserController');
        Route::delete('users/{user}/destroy', 'UserController@forceDestroy')->name('users.forceDestroy');
        Route::put('users/{user}/restore', 'UserController@restore')->name('users.restore');
        Route::put('users/{user}/approve', 'UserController@approve')->name('users.approve');
        Route::put('users/{user}/block', 'UserController@block')->name('users.block');

        Route::apiResource('subscriptions', 'SubscriptionController')->except('update');
        Route::delete('subscriptions/{subscription}/destroy', 'SubscriptionController@forceDestroy')->name('subscriptions.forceDestroy');
        Route::put('subscriptions/{subscription}/restore', 'SubscriptionController@restore')->name('subscriptions.restore');
        Route::put('subscriptions/{subscription}/activate', 'SubscriptionController@activate')->name('subscriptions.activate');
        Route::put('subscriptions/{subscription}/deactivate', 'SubscriptionController@deactivate')->name('subscriptions.deactivate');

        Route::apiResource('companies', 'CompanyController');
        Route::delete('companies/{company}/destroy', 'CompanyController@forceDestroy')->name('companies.forceDestroy');
        Route::put('companies/{company}/restore', 'CompanyController@restore')->name('companies.restore');
        Route::put('companies/{company}/approve', 'CompanyController@approve')->name('companies.approve');
        Route::put('companies/{company}/block', 'CompanyController@block')->name('companies.block');

        Route::group(['prefix' => 'companies/{company}'], function () {
            Route::apiResource('users', 'CompanyUserController');
            Route::delete('users/{user}/destroy', 'CompanyUserController@forceDestroy')->name('companyUsers.forceDestroy');
            Route::put('users/{user}/restore', 'CompanyUserController@restore')->name('companyUsers.restore');
        });

        Route::middleware('x.company')->group(function () {
            Route::apiResource('constructions', 'ConstructionController');
            Route::delete('constructions/{construction}/destroy', 'ConstructionController@forceDestroy')->name('constructions.forceDestroy');
            Route::put('constructions/{construction}/restore', 'ConstructionController@restore')->name('constructions.restore');
            Route::put('constructions/{construction}/cancel', 'ConstructionController@cancel')->name('constructions.cancel');
            Route::put('constructions/{construction}/start', 'ConstructionController@start')->name('constructions.start');
            Route::put('constructions/{construction}/pause', 'ConstructionController@pause')->name('constructions.pause');
            Route::put('constructions/{construction}/abandon', 'ConstructionController@abandon')->name('constructions.abandon');
            Route::put('constructions/{construction}/finalize', 'ConstructionController@finalize')->name('constructions.finalize');

            Route::group(['prefix' => 'constructions/{construction}'], function () {
                Route::apiResource('users', 'ConstructionUserController');
                Route::delete('users/{constructionUser}/destroy', 'ConstructionUserController@forceDestroy')->name('constructionUsers.forceDestroy');
                Route::put('users/{constructionUser}/restore', 'ConstructionUserController@restore')->name('constructionUsers.restore');

                Route::apiResource('stages', 'StageController');
                Route::delete('stages/{stage}/destroy', 'StageController@forceDestroy')->name('stages.forceDestroy');
                Route::put('stages/{stage}/restore', 'StageController@restore')->name('stages.restore');

                Route::apiResource('inspections', 'InspectionController');
                Route::delete('inspections/{inspection}/destroy', 'InspectionController@forceDestroy')->name('inspections.forceDestroy');
                Route::put('inspections/{inspection}/restore', 'InspectionController@restore')->name('inspections.restore');

                Route::apiResource('providers', 'ProviderController');
                Route::delete('providers/{provider}/destroy', 'ProviderController@forceDestroy')->name('providers.forceDestroy');
                Route::put('providers/{provider}/restore', 'ProviderController@restore')->name('providers.restore');

                Route::apiResource('products', 'ProductController');
                Route::delete('products/{product}/destroy', 'ProductController@forceDestroy')->name('products.forceDestroy');
                Route::put('products/{product}/restore', 'ProductController@restore')->name('products.restore');

                Route::group(['prefix' => 'products/{product}'], function () {
                    Route::apiResource('stocks', 'StockController')->except('update');
                    Route::delete('stocks/{stock}/destroy', 'StockController@forceDestroy')->name('stocks.forceDestroy');
                    Route::put('stocks/{stock}/restore', 'StockController@restore')->name('stocks.restore');
                    Route::put('stocks/{stock}/cancel', 'StockController@cancel')->name('stocks.cancel');
                    Route::put('stocks/{stock}/receive', 'StockController@receive')->name('stocks.receive');
                    Route::put('stocks/{stock}/withdraw', 'StockController@withdraw')->name('stocks.withdraw');
                });
            });
        });
    });
});
