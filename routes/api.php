<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'postal_code','as'=>'postal_code.'], function(){
    Route::post('store', ['as' => 'store', 'uses' => 'API\PostalCodeController@store']);
});

Route::group(['prefix'=>'street','as'=>'street.'], function(){
    Route::get('datatable', ['as' => 'datatable', 'uses' => 'API\StreetsController@datatable']);
    Route::post('store', ['as' => 'store', 'uses' => 'API\StreetsController@store']);
});
