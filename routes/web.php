<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

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
    return view('welcome');
});

Route::get('/restaurants', [RestaurantController::class, 'index'])
    ->name('restaurants.index');

Route::get('/restaurants/create', [\App\Http\Controllers\RestaurantController::class, 'create'])
    ->name('restaurants.create');

Route::post('/restaurants', [\App\Http\Controllers\RestaurantController::class, 'store'])
    ->name('restaurants.store');

Route::get('/restaurants/{restaurant}', [\App\Http\Controllers\RestaurantController::class, 'show'])
    ->name('restaurants.show');

Route::get('/restaurants/{restaurant}/edit', [\App\Http\Controllers\RestaurantController::class, 'edit'])
    ->name('restaurants.edit');

Route::put('/restaurants/{restaurant}', [\App\Http\Controllers\RestaurantController::class, 'update'])
    ->name('restaurants.update');

Route::delete('/restaurants/{restaurant}', [\App\Http\Controllers\RestaurantController::class, 'destroy'])
    ->name('restaurants.destroy');

/**
 * L'ensemble des routes liées à la gestion du restaurant
 * peut être remplacer par cette unique instruction
 */

//Route::resource('restaurants', RestaurantController::class);
