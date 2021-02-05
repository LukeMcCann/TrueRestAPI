<?php

use App\Http\Controllers\Buyer\BuyerCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Category\CategoryBuyerController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Transaction\BuyerProductController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionSellerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Buyers
Route::resource('buyers', BuyerController::class)->only(['index', 'show']);
Route::resource('buyers.transactions', BuyerTransactionController::class)->only(['index']);
Route::resource('buyers.products', BuyerProductController::class)->only(['index']);
Route::resource('buyers.sellers', BuyerSellerController::class)->only(['index']);
Route::resource('buyers.categories', BuyerCategoryController::class)->only(['index']);

// Sellers
Route::resource('sellers', SellerController::class)->only(['index', 'show']);
Route::resource('sellers.transactions', SellerTransactionController::class)->only(['index']);

// Categories
Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
Route::resource('categories.products', CategoryProductController::class)->only(['index']);
Route::resource('categories.sellers', CategorySellerController::class)->only(['index']);
Route::resource('categories.transactions', CategoryTransactionController::class)->only(['index']);
Route::resource('categories.buyers', CategoryBuyerController::class)->only(['index']);

// Products
Route::resource('products', ProductController::class)->only(['index', 'show']);

// Transactions
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
Route::resource('transactions.categories', TransactionCategoryController::class)->only(['index']);
Route::resource('transactions.sellers', TransactionSellerController::class)->only(['index']);

// Users
Route::resource('users', UserController::class)->except(['create', 'edit']);