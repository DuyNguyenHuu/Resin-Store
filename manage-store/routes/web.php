<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BCategoryController;
use App\Http\Controllers\BlogController;

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

Route::get('/', function () {
    return view('login');
});
Route::get('/home', function () {
    return view('layouts.home');
});

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::resource('/categories', CategoryController::class);
Route::resource('/subcategories', SubCategoryController::class);
route::resource('/productList', ProductListController::class);
route::resource('/bcategories', BCategoryController::class);
route::resource('/blogs', BlogController::class);

route::get('/productList/{productList}/attributes',[ProductListController::class, 'attribute'])->name('productList.attribute');
route::get('/productList/{productList}/attributes/create', [ProductListController::class, 'createAttribute'])->name('productList.createAttribute');
Route::post('/productList/{productList}/attributes', [ProductListController::class, 'storeAttribute'])->name('productList.storeAttribute');
Route::get('/productList/{productList}/attributes/{idOption}/edit',[ProductListController::class,'editAttribute'])->name('productList.editAttribute');
Route::put('/productList/{productList}/attributes/{idOption}',[ProductListController::class,'updateAttribute'])->name('productList.updateAttribute');
Route::delete('/productList/{productList}/attributes/{idOption}',[ProductListController::class,'destroyAttribute'])->name('productList.destroyAttribute');
Route::resource('/productReview', ProductReviewController::class);