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
Route::get('/games', [GameController::class, 'index'])->name('games.index');

Route::group(['middleware' => [Authorize::using('create games')]], function () {
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');

    Route::post('/games', [GameController::class, 'store'])->name('games.store');
});

Route::get('/assign-roles', [RoleController::class, 'assignRoles']);
Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(["verified"]);
