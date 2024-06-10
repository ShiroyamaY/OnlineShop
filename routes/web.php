<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->group(function()
    {
       Route::get('/login', 'index')
           ->name('login')
           ->middleware('guest');
       Route::post('/login', 'signIn')
           ->name('sign-in')
           ->middleware('guest');

       Route::get('/sign-up','signUp')
           ->name('sign-up')
           ->middleware('guest');
       Route::post('/sign-up','store')
           ->name('auth.store')
           ->middleware('guest');

       Route::get('/forgot-password','forgotPassword')->name('forgot-password');

       Route::delete('/logout','logOut')->name('logout');

    });

Route::prefix('email')->group(function(){
    Route::get('/verify',function(Request $request){
        if($request->user()->hasVerifiedEmail()){
            return redirect()->intended(route('home'));
        }
        return view('auth.verify-email');
    })->middleware('auth')
        ->name('verification.notice');

    Route::get('/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()
            ->intended(route('home'));
    })->middleware('auth', 'signed')
        ->name('verification.verify');

    Route::post('/verification-notification', function(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'Ссылка для подтверждения почты была отправлена!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});



Route::get('/',[HomeController::class,'index'])
    ->name('home');
