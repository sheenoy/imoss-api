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

Route::group(['prefix' => "v1", 'namespace' => "Api", 'name' => "ads."], function() {
    Route::match(["get", "post"], 'search', "AdsController@index")->name('list');
    Route::match(["get", "post"], 'save-flux-data', "AdsController@readXmlAndSaveData")->name('save');
    Route::match(["get", "post"], 'ads/{id}', "AdsController@detail")->name('detail');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
