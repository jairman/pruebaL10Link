<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::get('/tasks', 'App\Http\Controllers\Api\TaskController@index');
    Route::post('/tasks', 'App\Http\Controllers\Api\TaskController@store');
    Route::get('/tasks/{task}', 'App\Http\Controllers\Api\TaskController@show');
    Route::put('/tasks/{task}', 'App\Http\Controllers\Api\TaskController@update');
    Route::delete('/tasks/{task}', 'App\Http\Controllers\Api\TaskController@destroy');
    Route::get('/tasks/{task}/edit', 'App\Http\Controllers\Api\TaskController@edit');
    Route::get('/tasks/filter', 'App\Http\Controllers\Api\TaskController@filter');

});
