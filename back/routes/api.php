<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('events', [EventController::class, 'getAllEvent']);
Route::post('events', [EventController::class, 'createEvent']);
Route::get('events/{id}', [EventController::class, 'getOneEvent']);
Route::put('events/{id}', [EventController::class, 'updateEvent']);
Route::delete('events/{id}', [EventController::class, 'deleteEvent']);
Route::get('/category/search/{title}', [EventController::class, 'searchEvent']);
