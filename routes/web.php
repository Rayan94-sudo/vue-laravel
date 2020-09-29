<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('login');
});

$router->group([
    'middleware' => ['admin'],
], function($router){
Route::get('/admin',function(){
    return view ('admin');
});
Route::get('/admin/{any}',function(){
    return view ('admin');
});
Route::get('/admin/editclient/{any}', function () {
    return view('admin');
});
Route::get('/admin/editgroup/{any}', function () {
    return view('admin');

});
});

 