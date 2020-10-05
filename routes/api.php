<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Group_UserController;
use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login',  [AuthController::class,"login"]);
    Route::post('signup', [AuthController::class,"signup"]);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class,"logout"]);
    });
});
//only admin can :
// 1-->CRUD user
// 2-->Create group
// 3-->Add user to group

$router->group([
    'middleware' => [],
    'prefix' => 'admin'
], function($router){
    Route::get('/groups', [GroupController::class,"index"]);
    Route::get('/group/{id}', [GroupController::class,"show"]);
    Route::post('/group/update/{id}', [GroupController::class,"update"]);
    Route::post('/group/create', [GroupController::class,"store"]);
    Route::delete('/group/delete/{id}',[GroupController::class,"destroy"]);
    Route::get('/group/clients/{id}', [GroupController::class,"showClient"]);

    Route::get('/clients', [ClientController::class,"index"]);
    Route::get('/client/{id}', [ClientController::class,"show"]);
    Route::post('/client/update/{id}',[ClientController::class,"update"]);
    Route::post('/client/create', [ClientController::class,"store"]);
    Route::delete('/client/delete/{id}', [ClientController::class,"destroy"]);


});