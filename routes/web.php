<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
   Route::get('/login', 'index')->name('login');
   Route::post('/login', 'signIn')->name('sign-in');
   Route::get('/sign-up','signUp')->name('sign-up');
   Route::post('/sign-up','store')->name('auth.store');
   Route::get('/forgot-password','forgotPassword')->name('forgot-password');
   Route::delete('/logout','logOut')->name('logout');
});

Route::get('/',[HomeController::class,'index'])->name('home');
