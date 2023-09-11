<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\VideosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Mail\SendVerificationEmail as SendVerificationEmailMail;
use App\Models\User;
use App\Http\Controllers\AppleController;
use App\Http\Controllers\BookController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/v2', function () {
    return view('autherV2');
});

Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'registerPost']);

Route::get('/login',[AuthController::class,'login'])->name('login'); 
Route::post('/login',[AuthController::class,'loginPost']);
Route::post('/login1',[AuthController::class,'loginPost1'])->name('lolo');

Route::get('/home',[HomeController::class,'index'])->name('home');
Route::DELETE('/logout',[AuthController::class,'logout'])->name('logout');


Route::middleware(['auth.user'])->group(function () {
    // 訪問此路由需要驗證登入
    Route::get('/home',[HomeController::class,'index'])->name('home');

});
Route::get('/verify/{token}', [AuthController::class,'verifyEmail'])->name('verify.email');


Route::get('/employee',[AppleController::class,'index'])->name('Employee');
Route::delete('delete-all', [AppleController::class,'deleteAll'])->name('delete-all');

Route::get('/auth/{provider}/redirect', [AppleController::class,'redirect']);
 
Route::get('/auth/{provider}/callback',[AppleController::class,'callback']);

Route::post('/insertvideo',[VideosController::class,'insert'])->name('insert.file');
Route::get('/showvideo',[VideosController::class,'show'])->name('show');


Route::get('/BookBuy', [BookController::class, 'index']);  
Route::get('/shopping-cart', [BookController::class, 'bookCart'])->name('shopping.cart');
Route::get('/book/{id}', [BookController::class, 'addBooktoCart'])->name('addbook.to.cart');
Route::patch('/update-shopping-cart', [BookController::class, 'updateCart'])->name('update.sopping.cart');
Route::delete('/delete-cart-product', [BookController::class, 'deleteProduct'])->name('delete.cart.product');

Route::post('/paypal', [PaypalController::class, 'payment'])->name('paypal');
Route::get('/success', [PaypalController::class, 'success'])->name('success');
Route::get('/cancel', [PaypalController::class, 'cancel'])->name('cancel');
 
Route::get('/buyproducts', [ProductsController::class, 'index']);
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [ProductsController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove_from_cart');

