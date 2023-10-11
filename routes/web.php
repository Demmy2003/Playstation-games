<?php

use App\Http\Controllers\GameController;
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
Route::get('/games', [GameController::class, 'index'])->name('games');
Route::post('/games/create', [GameController::class, 'create'])->name('games.create');


Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(["verified"]);
