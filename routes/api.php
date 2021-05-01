<?php

use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoryBuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Product\ProductBuyerController;
use App\Http\Controllers\Product\ProductBuyerTransactionController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductTransactionController;
use App\Http\Controllers\Seller\SellerBuyerController;
use App\Http\Controllers\Seller\SellerCategoryController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;

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
Route::get('buyers/{buyer}/transactions', BuyerTransactionController::class)->name('buyers.transactions');
Route::get('buyers/{buyer}/products', BuyerProductController::class)->name('buyers.products');
Route::get('buyers/{buyer}/sellers', BuyerSellerController::class)->name('buyers.sellers');
Route::get('buyers/{buyer}/categories', BuyerCategoryController::class)->name('buyers.categories');

/**
 * Categories
 */
Route::resource('categories', CategoryController::class, ['except' => ['create', 'edit']]);
Route::get('categories/{category}/products', CategoryProductController::class)->name('categories.products');
Route::get('categories/{category}/sellers', CategorySellerController::class)->name('categories.sellers');
Route::get('categories/{category}/transactions', CategoryTransactionController::class)->name('categories.transactions');
Route::get('categories/{category}/buyers', CategoryBuyerController::class)->name('categories.buyers');

/**
 * Products
 */
Route::resource('products', ProductController::class, ['only' => ['index', 'show']]);
Route::resource('products.categories', ProductCategoryController::class, ['only' => ['index', 'update', 'destroy']]);
Route::post('products/{product}/buyers/{buyer}/transactions', ProductBuyerTransactionController::class)->name('products.buyers.transactions');
Route::get('products/{product}/transactions', ProductTransactionController::class)->name('products.transactions');
Route::get('products/{product}/buyers', ProductBuyerController::class)->name('products.buyers');

/**
 * Transactions
 */
Route::resource('transactions', TransactionController::class, ['only' => ['index', 'show']]);
Route::get('transactions/{transaction}/categories', TransactionCategoryController::class)->name('transactions.categories');
Route::get('transactions/{transaction}/sellers', TransactionSellerController::class)->name('transactions.sellers');

/**
 * Sellers
 */
Route::resource('sellers', SellerController::class, ['only' => ['index', 'show']]);
Route::get('sellers/{seller}/transactions', SellerTransactionController::class)->name('sellers.transactions');
Route::get('sellers/{seller}/categories', SellerCategoryController::class)->name('sellers.categories');
Route::get('sellers/{seller}/buyers', SellerBuyerController::class)->name('sellers.buyers');
Route::resource('sellers.products', SellerProductController::class, ['except' => ['create', 'show', 'edit']]);

/**
 * Users
 */
Route::get('users/me', [UserController::class, 'me'])->name('me');
Route::resource('users', UserController::class, ['except' => ['create', 'edit']]);
Route::get('users/verify/{token}', [UserController::class, 'verify'])->name('verify');
Route::get('users/{user}/resend', [UserController::class, 'resend'])->name('resend');

Route::post('oauth/token', [AccessTokenController::class, 'issueToken']);