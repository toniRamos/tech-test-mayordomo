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

Route::get('ping', 'PingController@ping');

Route::get('testSession', 'PingController@session');

Route::post('game/{id}' , 'GameController@create');

Route::get('game/{id}' , 'GameController@get');

Route::post('game/{id}/player/{player}/moveFrom/{position_from}/moveTo/{position_move}' , 'GameController@move');