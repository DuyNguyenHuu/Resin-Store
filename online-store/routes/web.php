<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BlogsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('content.authentication.login');
});
Route::get('/forgotpassword',function (){
    return view('content.authentication.forgotpassword');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/{idProduct}', [ProductsController::class, 'detailProduct']);
Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blogs/category={idBCategory}', [BlogsController::class, 'index']);
Route::get('/blogs/{idBlog}', [BlogsController::class, 'detailBlog']);
// route::get('/productList/{productList}/attributes',[ProductListController::class, 'attribute'])->name('productList.attribute');