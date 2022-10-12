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
    ->name('restaurants.index')
    ->middleware(['can:viewAny,App\Models\Restaurant']);

Route::get('/restaurants/create', [RestaurantController::class, 'create'])
    ->name('restaurants.create')
    ->middleware(['auth', 'can:create,App\Models\Restaurant']);

Route::post('/restaurants', [RestaurantController::class, 'store'])
    ->name('restaurants.store')
    ->middleware(['auth', 'can:create,App\Models\Restaurant']);

Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])
    ->name('restaurants.show')
    ->middleware(['can:view,restaurant']);

Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])
    ->name('restaurants.edit')
    ->middleware(['auth', 'can:update,restaurant']);

Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])
    ->name('restaurants.update')
    ->middleware(['auth', 'can:update,restaurant']);

Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])
    ->name('restaurants.destroy')
    ->middleware(['auth', 'can:delete,restaurant']);

/**
 * L'ensemble des routes liées à la gestion du restaurant
 * peut être remplacé par cette unique instruction
 */

//Route::resource('restaurants', RestaurantController::class);
