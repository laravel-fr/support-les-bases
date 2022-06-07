<?php

use Illuminate\Support\Facades\Route;

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

Route::get('whoami', function () {
    $user = Illuminate\Support\Facades\Auth::user();

    echo $user ? $user->name : 'no body';
});

Route::get('auth', function () {
    $user = App\Models\User::first() ?: App\Models\User::factory()->create();

    Illuminate\Support\Facades\Auth::login($user);

    return redirect('/whoami');
});
