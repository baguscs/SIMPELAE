<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\AparatController;
use App\Http\Controllers\AkunController;

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
Route::get('/master', function () {
    return view('template.master');
});
Route::get('LogoutSystem', [DashboardController::class, 'logout'])->name('logOut');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/updateProfile', [ProfileController::class, 'update'])->name('updateProfile');
    Route::get('/changePassword', [ProfileController::class, 'password'])->name('changePassword');
    Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');

    //warga
    Route::resource('/warga', WargaController::class);

    //aparat
    Route::resource('/aparat', AparatController::class);

    //akun
    Route::resource('/akun', AkunController::class);
    Route::get('cek-email', function ()
    {
       return view('template.akun.send-email');
    });
});
