<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Support for Auth controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



//👉 - https://demos.pixinvent.com/vuexy-vuejs-admin-template/documentation/guide/laravel-integration/laravel-passport-authentication.html#step-1-create-route
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    // TEST

    Route::post('update/{id}', [AuthController::class, 'update']);
    // Route::put('update/{id}', [AuthController::class, 'update']);

    Route::group(['middleware' => 'auth:api'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
    });
});


// 👉 Test For Event
Route::group(['prefix' => 'event'], function () {
  Route::post('create', [EventController::class, 'create']);
  Route::post('update/{id}', [EventController::class, 'update']);
  Route::post('delete', [EventController::class, 'delete']);
  
});


//👉 - For Company
Route::group(['prefix' => 'company'], function() {
  Route::post('create', [CompanyController::class, 'create']);
  Route::post('update', [CompanyController::class, 'update']);
  Route::post('delete', [CompanyController::class, 'delete']);
});
