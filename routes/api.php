<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

Route::post('/login', 'Auth\LoginController@authenticate');


Route::get('/contents', 'ContentController@index')->middleware('auth');
Route::get('/contents2','ContentController@index2');

Route::get('/cal', function() {
    return response()->json([]);;
})->middleware('auth');

Route::put('/contents/{content}', 'ContentController@update');
Route::get('/tasks', 'TaskController@index');
Route::post('/tasks', 'TaskController@store');
Route::get('/tasks/{task}', 'TaskController@show');
Route::put('/tasks/{task}', 'TaskController@update');
Route::delete('/tasks/{task}', 'TaskController@destroy');


Route::resource('actionhiss', ActionHisController::class);


