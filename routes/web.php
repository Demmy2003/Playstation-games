<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\RoleController;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//
//Route::post('/games', [GameController::class, 'store'])->name('games.store');
//Route::get('/games/create', [GameController::class, 'create'])->name('games.create')->middleware('admin');

//general game overview
Route::get('/games', [GameController::class, 'index'])->name('games.index');

// Game detail overview
Route::get('/games/{game}', [GameController::class, 'detail'])->name('games.detail');

// only with permission can create games
Route::group(['middleware' => [Authorize::using('create games')]], function () {
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');

    Route::post('/games', [GameController::class, 'store'])->name('games.store');
});
// only with permission can edit games
Route::group(['middleware' => [Authorize::using('edit games')]], function () {
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
});
Route::group(['middleware' => [Authorize::using('delete games')]], function () {
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});

Route::get('/assign-roles', [RoleController::class, 'assignRoles']);
Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(["verified"]);
