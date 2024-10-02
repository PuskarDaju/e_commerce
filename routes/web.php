<?php

use App\Http\Controllers\AdminButtonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserButtonController;
use App\Http\Controllers\UserOrderController;
use App\Http\Middleware\isUserLoggedIn;
use Illuminate\Support\Facades\Route;



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
    Route::get('/', 'dashBoard')->name('dash');

});

Route::middleware(isUserLoggedIn::class)->group(function(){
    Route::controller(AdminButtonController::class)->group(function(){
        Route::get('productTable','gotoProductTable')->name('productTable');
        
    });
    Route::resource('product',ProductController::class);
    
    Route::controller(UserButtonController::class)->group(function(){
        Route::get('/allProducts','displayProducts')->name('viewProducts');
        Route::get('/cart',"gotoCart")->name('gotoCart');
        Route::post('/search','searchMyProduct')->name('search');
        Route::get('/profile','gotoAccount')->name('profile');
        Route::post('/changeProfile',function(){
            return "hello world";
        })->name('profileChange');
        
    });
    Route::controller(UserOrderController::class)->group(function(){
        Route::get('/Cart','gotoCart')->name('viewMyCart');
        Route::post('/addToCart','addToCart')->name('addToCart');
        Route::delete('/deleteFromMyCart','deleteMyItem')->name('deleteFromMyCart');
        Route::POST('/addToOrders','addOrder')->name('addToOrders');
        
    });
    
});
