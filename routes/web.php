<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.dashboard');
});

Route::get('/login',function(){
    return view('Authentication.login');
})->name('login');

Route::get('/signUp',function(){
    return view('Authentication.register');
})->name('signUp');

Route::controller(AuthController::class)->group(function(){
    Route::post('/checkLogin','logMeIn')->name('checkLogin');
    Route::post('/register','registerMe')->name('registerMe');
    Route::get('logout','logMeOut')->name('logout');

});
