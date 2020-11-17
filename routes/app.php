<?php 

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Routes for app api
|--------------------------------------------------------------------------
|  Feel free to modify this routes 
|
*/


//route for email verification and password resets
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

Route::get('/','CustomerController@index')->name('user.dashboard'); //shows the user dashboard
Route::get('/product/category/{category}','CustomerController@productCategory')->name('product.tag'); //displays the products in category
Route::get('/product/{id}','CustomerController@showProduct'); //shows the product based on id
Route::post('/addToCart','CustomerController@addToCart');     //adds the product to cart
Route::get('/cartbadge','CustomerController@cartBadge');      //shows the cart badge
Route::get('/cart','CustomerController@cart');                 //shows the cart page
Route::post('/updatequantity','CustomerController@updateQuantity');   //updates the quantity of the product in the cart
Route::get('deleteitem/{id}','CustomerController@deleteitem');        //deletes the item in the cart
Route::post('/addToOrder','CustomerController@addToOrder');   //adds the cart items to order
Route::get('/orders','CustomerController@RequestedOrders')->name('customer.orders');   //shows the requested orders
Route::get('/order/{id}','CustomerController@orderDetail')->name('customer.order.detail');  //shows the detail of each order
Route::get('/admin','Auth\AdminsLoginController@showLoginForm')->name('admin.login');       //shows the admin log page
Route::post('/admin','Auth\AdminsLoginController@login')->name('admin.login.submit'); //submits the admins login request 


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


?>