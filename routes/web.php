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

Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.pages.dashboard')->name('admin.dashboard');

    Route::prefix('movie')->group(function () {
        Route::get('/', [App\Http\Controllers\admin\MovieController::class, 'index'])->name('admin.movie');
        Route::get('/create', [App\Http\Controllers\admin\MovieController::class, 'create'])->name('admin.movie.create');
        Route::post('/store', [App\Http\Controllers\admin\MovieController::class, 'store'])->name('admin.movie.store');
        Route::get('/{id}/edit', [App\Http\Controllers\admin\MovieController::class, 'edit'])->name('admin.movie.edit');
        Route::put('/{id}/update', [\App\Http\Controllers\admin\MovieController::class, 'update'])->name('admin.movie.update');
        Route::delete('/{id}/delete', [App\Http\Controllers\admin\MovieController::class, 'destroy'])->name('admin.movie.delete');
    });

});

// Route::get('/', function () {
//     return view('welcome');
// });
