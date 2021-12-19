<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\AuthenticationController;
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




// Nologin
Route::get(
    '/home',
    [DashboardController::class, 'getHome']
)->name('home');

Route::get(
    '/buku/{id}',
    [DashboardController::class, 'getBook']
)->name('buku');

Route::get(
    '/search}',
    [DashboardController::class, 'searchBook']
)->name('search');


Route::middleware(['middleware' => 'alreadylogin'])->group(function () {
    Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');
    
    Route::get('/register', [AuthenticationController::class, 'showRegister'])->name('auth.showRegister');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('auth.register');
    
});


// login
Route::middleware(['middleware' => 'logincheck', 'admincheck'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'getAdminHome'])->name('dashboard');
    
    Route::resource('book', BooksController::class);

});
Route::middleware(['middleware' => 'logincheck'])->group(function () {
    Route::post('logout', function () {
        Session::flush();
        return redirect('/home');
    })->name('logout');
    
    Route::post(
        '/checkout/{id}',
        [ReservationsController::class, 'borrowing']
    )->name('borrowing');
    
    Route::post(
        '/checkin/{id}',
        [ReservationsController::class, 'returning']
    )->name('returning');
});


