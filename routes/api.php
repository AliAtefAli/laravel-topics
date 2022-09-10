<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('api/users', [\App\Http\Controllers\Api\V1\UsersController::class, 'index'])->name('api.users.index');
//Route::get('api/users', 'Api\V1\UsersController@index.vue');
Route::post('api/messages/{user_id?}', 'Api\V1\MessagesController@index.vue')->name('api.messages.index');
Route::post('api/messages/send', 'Api\V1\MessagesController@store');

/** Auth :START */
Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
/** Auth :END */
