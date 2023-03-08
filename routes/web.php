<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::resource("chat", \App\Http\Controllers\ChatController::class);
Route::post("chat/getDataUser", [\App\Http\Controllers\ChatController::class, "getDataUser"]);
Route::post("chat/createMessage", [\App\Http\Controllers\ChatController::class, "createMessage"]);
Route::controller(App\Http\Controllers\PaymentProviderController::class)->group(function () {
  Route::get('/payment', 'index')->name('payment');
  Route::post('/payment/checkout', 'getCheckoutId')->name('checkout');
  Route::get('/payment/callbackCheckout', 'callbackCheckout')->name('callbackCheckout');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
