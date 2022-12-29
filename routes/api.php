<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Game;
use App\Models\Genre;
use App\Models\User;
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

Route::post('/search/game', [App\Http\Controllers\GameController::class,'search'])->name('search_game');

Route::resource('game', App\Http\Controllers\GameController::class);
Route::resource('trans', App\Http\Controllers\TransactionController::class);
Route::resource('customer', App\Http\Controllers\CustomerController::class);
Route::resource('employee', App\Http\Controllers\EmployeeController::class);
Route::resource('genre', App\Http\Controllers\GenreController::class);

// Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh_page', 'refresh');
// });


Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\VerifyEmailController::class, 'verifyEmail'])->name('verification.verify');


Route::post('/game/update/{id}',[App\Http\Controllers\GameController::class,'update'])->name('game_update');
Route::post('/genre/update/{id}',[App\Http\Controllers\GenreController::class,'update'])->name('genre_update');
Route::post('/employee/update/{id}',[App\Http\Controllers\EmployeeController::class,'update'])->name('employee_update');
Route::post('/customer/update/{id}',[App\Http\Controllers\CustomerController::class,'update'])->name('customer_update');


// get data and return as json object
Route::get('/vapor/home/games', function () {
    // dd(Game::with(['comments','genre'])->orderBy('title','DESC')->get());
        $games = Game::with(['comments','genre'])->paginate(8);
        return response()->json($games);
});

Route::get('/vapor/all/games', function (Request $request) {
    // dd(Game::with(['comments','genre'])->orderBy('title','DESC')->get());
        $games = Game::with(['comments','genre'])->get();
        return response()->json($games);
});
Route::get('/vapor/all/customers', function (Request $request) {
    // dd(Game::with(['comments','genre'])->orderBy('title','DESC')->get());
    $customer = User::withTrashed()->where('role',1)->get();
    return response()->json($customer);
});

Route::get('/vapor/all/employees', function (Request $request) {
    // dd(Game::with(['comments','genre'])->orderBy('title','DESC')->get());
    $emp = User::withTrashed()->where('role',2)->get();
    return response()->json($emp);
});

Route::get('/vapor/all/genres', function (Request $request) {
    // dd(Game::with(['comments','genre'])->orderBy('title','DESC')->get());

    if ($request->ajax()){
        $genre = Genre::orderBy('genre','ASC')->get();
        return response()->json($genre);
    }

});

Route::get('/customer/restore/{id}', [App\Http\Controllers\CustomerController::class,'restore'])->name('crestore');
Route::get('/employee/restore/{id}', [App\Http\Controllers\EmployeeController::class,'restore'])->name('erestore');
