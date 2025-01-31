<?php

use App\Http\Controllers\AdminButtonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserButtonController;
use App\Http\Controllers\UserOrderController;
use App\Http\Middleware\isUserLoggedIn;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SalesController;


Route::get('/login',function(){
    return view('Authentication.login');
})->name('login');

Route::get('/signUp',function(){
    return view('Authentication.register');
})->name('signUp');

Route::controller(AuthController::class)->group(function(){
    Route::post('/checkLogin','logMeIn')->name('checkLogin');
    Route::post('/register','registerMe')->name('registerMe');
    Route::get('/logout','logMeOut')->name('logout');
    Route::get('/', 'dashBoard')->name('dash');

});

Route::middleware(isUserLoggedIn::class)->group(function(){
    Route::controller(AdminButtonController::class)->group(function(){
        Route::get('productTable','gotoProductTable')->name('productTable');
        Route::get('/allOrders','gotoAllOrder')->name('allOrders');
        Route::get('/adminProfile','gotoAdminProfile')->name('adminProfile');
        Route::get('/aproveOrder/{id}','approveOrder')->name('approveOrder');
        Route::get('/declineOrder/{id}','declineOrder')->name('declineOrder');
        Route::get('/delivery','showGuys')->name('delivery');
        Route::post('/checkDelivery','confirmDelivery')->name('confirmDelivery');
        Route::post('/checkIfCorrect','cic')->name('checkIfCorrect');
        Route::get('/lc/{id}','gotoLastConfirm')->name('lc');

        
       
        
    });
    Route::resource('product',ProductController::class);
    
    Route::controller(UserButtonController::class)->group(function(){
        Route::get('/allProducts','displayProducts')->name('viewProducts');
        Route::get('/cart',"gotoCart")->name('gotoCart');
        Route::get('/order',"gotoOrder")->name('gotoOrder');
        Route::post('/search','searchMyProduct')->name('search');
        Route::get('/profile','gotoAccount')->name('profile');
        Route::get('/notification','gotoNotification')->name('notification');

        
        
    });
    Route::controller(UserOrderController::class)->group(function(){
        Route::get('/Cart','gotoCart')->name('viewMyCart');
        Route::post('/addToCart','addToCart')->name('addToCart');
        Route::delete('/deleteFromMyCart','deleteMyItem')->name('deleteFromMyCart');
        Route::post('/addToOrders','addOrder')->name('addToOrders');
        Route::post('/addOrders','addSingle')->name('addOrders');
        Route::post('/paymentByUser','paymentByUser')->name('payment');
        
    });
    Route::post('/changeProfile',[MyProfileController::class,"changeDetails"])->name('profileChange');
  


Route::post('checkout', [PaymentController::class, 'processPayment'])->name('checkout.process');
Route::get('checkout/success', [PaymentController::class, 'success'])->name('payment.success');


Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');


    
});
