<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


Route::get('/','CustomerController@index')->name('user.dashboard');
Route::get('/product/category/{id}','CustomerController@productCategory')->name('product.tag');
Route::get('/contactus','CustomerController@contactus')->name('contact');
Route::get('/product/{id}','CustomerController@showProduct');
Route::post('/addToCart','CustomerController@addToCart');
Route::get('/cartbadge','CustomerController@cartBadge');
Route::get('/cart','CustomerController@cart');
Route::post('/updatequantity','CustomerController@updateQuantity');
Route::get('deleteitem/{id}','CustomerController@deleteitem');
Route::post('/confirm','CustomerController@confirmDetail');
Route::post('/addToOrder','CustomerController@addToOrder');
Route::get('/orders','CustomerController@RequestedOrders')->name('customer.orders');
Route::get('/order/{id}','CustomerController@orderDetail')->name('customer.order.detail');
Route::post('/search','CustomerController@search')->name('search');
Route::get('/admin','Auth\AdminsLoginController@showLoginForm')->name('admin.login');
Route::post('/contactus/message','CustomerController@sendmessage')->name('contactus.message');

Route::post('/admin','Auth\AdminsLoginController@login')->name('admin.login.submit');

//Routes for admins
Route::prefix('/admin')->group(function()
{
    Route::get('/dashboard','AdminsController@dashboard')->name('admin.dashboard');
    Route::get('/product/delete/{id}','AdminsController@productDelete')->name('admin.product.delete');
    Route::post('/showProductDetails/sort','AdminsController@sortByTag');
    Route::post('/addProduct','AdminsController@addProduct')->name('admin.addProduct');
    Route::get('/new_product','AdminsController@newProduct')->name('admin.new_product');
    Route::get('/editProduct/{id}','AdminsController@update');
    Route::post('/editProduct/{id}','AdminsController@updateProduct');
    Route::get('/orders','AdminsController@orders')->name('admin.orders');
    Route::post('/orders/sort','AdminsController@sortOrders');
    Route::get('/orderdetail/{id}','AdminsController@orderdetail')->name('order.detail');
    Route::get('/orderconfirm/{id}','AdminsController@orderconfirm')->name('order.confirm');
    Route::get('/messages','AdminsController@messages')->name('customer.messages');
    Route::get('/message/delete/{id}','AdminsController@messageDelete')->name('message.delete');
    Route::get('/message/detail/{id}','AdminsController@messageDetail')->name('message.detail');


});

Auth::routes();

