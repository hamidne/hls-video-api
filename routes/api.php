<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'videos', 'namespace' => 'Video'], function () {
	Route::get('', 'VideoIndexController');
	Route::post('', 'VideoStoreController');
	Route::get('{video}', 'VideoShowController');
	Route::put('{video}', 'VideoUpdateController');
	Route::delete('{video}', 'VideoDeleteController');
});
