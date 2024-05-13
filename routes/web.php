<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaperNoteController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\RedirectMiddleware;



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

Route::middleware([RedirectMiddleware::class])->group(function () {
    // LOGIN REGISTER
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');
    Route::post('/Createregister', [AuthController::class, 'Createregister'])->name('Createregister');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // RESET PASSWORD
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('forgot-password', 'request')->name('password.request');
        Route::post('forgot-password', 'sendEmail')->name('password.email');
        Route::get('reset-password/{token}', 'resetPassword')->name('password.reset');
        Route::post('reset-password', 'updatePassword')->name('password.update');
    });
});

Route::controller(PaperNoteController::class)->prefix('papernote')->group(function () {
    Route::get('/', 'index')->name('papernote');
    Route::get('/create', 'create')->name('papernote.create');
    Route::post('/store', 'store')->name('papernote.store');
    Route::get('/edit/{id}', 'edit')->name('papernote.edit');
    Route::put('/edit/{id}', 'update')->name('papernote.update');
    Route::delete('destroy/{id}', 'destroy')->name('papernote.destroy');
});
