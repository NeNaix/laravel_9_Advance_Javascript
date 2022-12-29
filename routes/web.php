<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;
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
Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh_page', 'refresh');

});

// Auth::routes();

Route::get('/', function () {
    return view('home',['games'=> Game::with(['comments','genre'])->orderBy('title','DESC')->get()]);
})->name('/');
