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
Route::post('/loginuser', [UserController::class, "loginuser"]);
Route::post('/register', [UserController::class, "register"])->middleware('guest');
Route::get('/login', [UserController::class, "showCorrectHomepage"])->name('login');
Route::get('/admin', [UserController::class, "admin"])->name('user.admin')->middleware('https');
Route::post('/admin/store', [UserController::class, 'adminStore'])->name('admin.store')->middleware('https');


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


//User Related Profile
Route::get('/user/create', [UserController::class, "create"])->name('user.create');
Route::get('/user/{user}', [UserController::class, 'showUserProfile'])->name('user.profile');
Route::put('/user/{user}', [UserController::class, 'updateUserProfile'])->name('user.profile.update');
Route::get('/user/{user}/edit', [UserController::class, 'editUserProfile'])->name('user.edit');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}/restaurants', [UserController::class, 'showUserRestaurants'])->name('user.restaurants');
Route::get('/user/{user}/restaurants/create', [UserController::class, 'createUserRestaurant'])->name('user.restaurants.create');
Route::post('/user/{user}/restaurants', [UserController::class, 'storeUserRestaurant'])->name('user.restaurants.store');
Route::get('/user/{user}/restaurants/{restaurant}', [UserController::class, 'showUserRestaurantProfile'])->name('user.restaurants.show');
Route::delete('/user/{user}/restaurants/{restaurant}', [UserController::class, 'destroyUserRestaurant'])->name('user.restaurants.destroy');
Route::get('/user/{user}/restaurants/{restaurant}/edit', [UserController::class, 'editUserRestaurant'])->name('user.restaurants.edit');


Route::put('/user/{user}/restaurants/{restaurant}', [UserController::class, 'updateUserRestaurant'])->name('user.restaurants.update');


