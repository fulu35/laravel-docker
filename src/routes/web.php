<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\ApiUserController;

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


Route::get('/store', function() {
    Redis::set('foo', 'bar');
});

Route::get('/retrieve', function() {
    // return "test";
    return Redis::get('foo');
});

Route::get('/', function () {
    return view('welcome');
});

 
Route::resource('api-users', ApiUserController::class);
Route::get('api-users-forms', [ApiUserController::class, 'showForm'])->name('api-users.show_form');
