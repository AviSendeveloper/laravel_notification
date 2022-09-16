<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\IndexController;
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

Route::get('/', [IndexController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function() {
    // login
    Route::get('login', [AuthController::class, 'loginPage'])->name('loginPage');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    // register
    Route::get('register', [AuthController::class, 'registerPage'])->name('registerPage');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::middleware('admin')->group(function() {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
        // new user notification
        Route::get('notify', [HomeController::class, 'notify'])->name('notify');
    });
});

require __DIR__.'/auth.php';
