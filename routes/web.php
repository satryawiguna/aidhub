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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('/user')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');

    Route::get('/address/{address}', [App\Http\Controllers\UserController::class, 'getAddress'])->name('get.address');
});
