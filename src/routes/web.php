<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Models\Contact;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

// こちらは一般のお問い合わせルート
Route::get('/', [ContactController::class, 'index']);
Route::post('contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::get('contact/confirm', [ContactController::class, 'showContactForm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// 管理者用ルート（admin）
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/{id}', [AdminController::class, 'show'])->name('show');  // 詳細表示
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy'); // 削除
});







