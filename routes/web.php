<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MuzakkiController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

//Muzakki Route
Route::prefix('muzakki')->group(function () 
{
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['muzakki'])->group(function ()
{
    Route::get('/landingPage', [MuzakkiController::class, 'index']);
});

