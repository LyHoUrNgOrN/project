<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Event_JoinController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('signup',[UserController::class, "createUser"]);
Route::post('signin',[UserController::class, "signIn"]);
Route::post('signout',[UserController::class, "signOut"]);

Route::get('users',[UserController::class, "getUsers"]);
Route::get('users/{id}',[UserController::class, "getUser"]);
Route::post('users',[UserController::class, "createUser"]);
Route::put('users/{id}',[UserController::class, "updateUser"]);
Route::delete('users/{id}',[UserController::class, "deleteUser"]);


// CATEGORY 

Route::get('category',[CategoryController::class,'getAllCategory']);
Route::post('category',[CategoryController::class,'createCategory']);
Route::get('category/{category_id}',[CategoryController::class,'show']);
Route::put('category/{category_id}',[CategoryController::class,'updateCategory']);
Route::delete('category/{category_id}',[CategoryController::class,'deleteCategory']);
Route::get('/category/search/{name}', [CategoryController::class, 'searchCategory']);


// Event
Route::get('events', [EventController::class, 'getAllEvent']);
Route::post('events', [EventController::class, 'createEvent']);
Route::get('events/{id}', [EventController::class, 'getOneEvent']);
Route::put('events/{id}', [EventController::class, 'updateEvent']);
Route::delete('events/{id}', [EventController::class, 'deleteEvent']);
Route::get('/events/search/{title}', [EventController::class, 'searchEvent']);

Route::get('/countries', [CountryController::class, 'getCountries']);


// Event_Join
Route::get("event_joins",[Event_JoinController::class, "index"]);
Route::post("event_joins",[Event_JoinController::class, "store"]);
Route::get("event_member/{eventId}",[Event_JoinController::class, "getMemberJoinEvent"]);
Route::get("event_user_has_joins/{userId}",[Event_JoinController::class, "getEventOfUserHasJoin"]);
Route::get("event_users/{userId}",[Event_JoinController::class, "getEventOfUser"]);
Route::get("event_other/{userId}",[Event_JoinController::class, "getEvent"]);

