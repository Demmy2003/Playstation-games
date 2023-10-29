<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateController;
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

//general game overview
Route::get('/games', [GameController::class, 'index'])->name('games.index');

// Game detail overview
Route::get('/games/{game}', [GameController::class, 'detail'])->name('games.detail');
Route::post('/games/{game}', [GameController::class, 'comment'])->name('games.comment')->middleware('user');
Route::get('/search', [GameController::class, 'search'])->name('games.search');
Route::get('/filter', [GameController::class, 'filter'])->name('games.filter');

Route::get('/user/comments', [GameController::class, 'showUserComments'])->name('user.comments')->middleware('user');

// Define a route for liking a game
Route::get('/games/{game}/{rate}', [GameController::class, 'rate'])->name('games.rate');

// only with permission can create games
Route::group(['middleware' => ['auth',Authorize::using('create games')]], function () {
    Route::get('/create_games',[CreateController::class, 'create'] )->name('create-games');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
});
// only with permission can edit games
Route::group(['middleware' => [Authorize::using('edit games')]], function () {
    Route::get('/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
});
Route::group(['middleware' => [Authorize::using('delete games')]], function () {
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});

Route::get('/assign-roles', [RoleController::class, 'assignRoles']);
Auth::routes(['verify'=>true]);

Route::get('/admin/index', [AdminController::class,'index'])->name('admin.index')->middleware('admin');
Route::post('/admin/index/{user}', [AdminController::class,'assign'])->name('admin.assign')->middleware('admin');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(["verified"]);
