<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\member\DashboardController;
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
Route::view('/', 'index')->name('home');
Route::get('/subscription-price', [App\Http\Controllers\MainController::class, 'pricing'])->name('home.pricelist');
Route::view('/payment-success', 'member.payment-success', ['title' => 'Payment Success']);

Route::middleware('guest')->group(function(){
    Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.login.auth');

    Route::get('/register', [App\Http\Controllers\member\AuthController::class, 'register'])->name('member.register');
    Route::post('/register', [\App\Http\Controllers\member\AuthController::class, 'register_store'])->name('member.store');
    Route::get('/login', [App\Http\Controllers\member\AuthController::class, 'login'])->name('member.login');
    Route::post('/login', [App\Http\Controllers\member\AuthController::class, 'auth'])->name('member.authentication');
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::view('/', 'admin.pages.dashboard')->name('admin.dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/transaction', [App\Http\Controllers\admin\TransactionController::class, 'index'])->name('admin.transaction');

    Route::prefix('movie')->group(function () {
        Route::get('/', [App\Http\Controllers\admin\MovieController::class, 'index'])->name('admin.movie');
        Route::get('/create', [App\Http\Controllers\admin\MovieController::class, 'create'])->name('admin.movie.create');
        Route::post('/store', [App\Http\Controllers\admin\MovieController::class, 'store'])->name('admin.movie.store');
        Route::get('/{id}/edit', [App\Http\Controllers\admin\MovieController::class, 'edit'])->name('admin.movie.edit');
        Route::put('/{id}/update', [\App\Http\Controllers\admin\MovieController::class, 'update'])->name('admin.movie.update');
        Route::delete('/{id}/delete', [App\Http\Controllers\admin\MovieController::class, 'destroy'])->name('admin.movie.delete');
    });

});

Route::prefix('member')->middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('member.dashboard');

    Route::post('/transaction', [\App\Http\Controllers\member\TransactionController::class, 'store'])->name('member.transaction.store');


    Route::get('/subscription', [DashboardController::class, 'subscription'])->name('member.subscription');
    Route::delete('/subscription/{id}', [DashboardController::class, 'stop_subscription'])->name('member.subscription.destroy');
    Route::get('/movie/{id}', [DashboardController::class, 'movie_detail'])->name('member.movie.detail');
    Route::get('/movie/{movie}/watch', [DashboardController::class, 'movie_watch'])->name('member.movie.watch');
    Route::get('/logout', [App\Http\Controllers\member\AuthController::class, 'logout'])->name('member.logout');
});

// Route::get('/', function () {
//     return view('welcome');
// });
