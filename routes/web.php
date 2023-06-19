<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;

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


Route::get('/', [UserController::class, "homepage"]);
Route::get('/add-to-home', UserController::class, 'addToHome')->name('addToHome');
Route::post('/loginuser', [UserController::class, "loginuser"]);
Route::post('/register', [UserController::class, "register"])->middleware('guest');
Route::get('/login', [UserController::class, "showCorrectHomepage"])->name('login');
Route::post('/logout', [UserController::class, "logout"])->middleware('auth');
Route::post('/result', [UserController::class, 'result'])->name('restaurants.result')->middleware('web');

//Restaurant Related Routes
Route::get('/restaurant', [RestaurantController::class, "ShowRestaurantForm"])->middleware('auth');
Route::post('/restaurant', [RestaurantController::class, "createNewRestaurant"])->middleware('auth');
Route::get('/restaurant/{restaurant}', [RestaurantController::class, "SingleRestaurantProfile"])->name('restaurant.show');;
Route::delete('/restaurant/{restaurant}', [RestaurantController::class, "delete"])->middleware('can:delete,restaurant');;
Route::get('/restaurant/{restaurant}/edit', [RestaurantController::class, "EditRestaurantForm"])->middleware('can:update,restaurant');
Route::put('/restaurant/{restaurant}', [RestaurantController::class, "SaveRestaurantEdit"])->middleware('can:update,restaurant');


//Menu Related Routes
Route::get('/restaurant/{restaurant}/menus/create/{weekday}', [MenuController::class, 'create'])->name('menus.create');
Route::post('/restaurant/{restaurant}/menus/{weekday}', [MenuController::class, 'store'])->name('menus.store');
Route::get('/restaurant/{restaurant}/menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
Route::get('/restaurant/{restaurant}/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
Route::put('/restaurant/{restaurant}/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
Route::delete('/restaurant/{restaurant}/menus/{weekday}', [MenuController::class, 'destroy'])->name('menus.destroy');
