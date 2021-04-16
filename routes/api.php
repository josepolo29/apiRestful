<?php

use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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

/**
 * Buyers
 */
Route::resource('buyers', BuyerController::class, ['only' => ['index', 'show']]);
Route::get('buyers/{buyer}/transactions', BuyerTransactionController::class);
Route::get('buyers/{buyer}/products', BuyerProductController::class);
Route::get('buyers/{buyer}/sellers', BuyerSellerController::class);
Route::get('buyers/{buyer}/categories', BuyerCategoryController::class);

/**
 * Categories
 */
Route::resource('categories', CategoryController::class, ['except' => ['create', 'edit']]);

/**
 * Products
 */
Route::resource('products', ProductController::class, ['only' => ['index', 'show']]);

/**
 * Transactions
 */
Route::resource('transactions', TransactionController::class, ['only' => ['index', 'show']]);
Route::get('transactions/{transaction}/categories', TransactionCategoryController::class);
Route::get('transactions/{transaction}/sellers', TransactionSellerController::class);

/**
 * Sellers
 */
Route::resource('sellers', SellerController::class, ['only' => ['index', 'show']]);

/**
 * Users
 */
Route::resource('users', UserController::class, ['except' => ['create', 'edit']]);