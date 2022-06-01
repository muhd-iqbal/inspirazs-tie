<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn () => view('home', [
    'products' => Product::with('category')->where('active', 1)->get(),
    'categories' => ProductCategory::where('featured', 1)->get(),
]));

Route::get('about', fn () => view('about'));
Route::get('contact', fn () => view('contact'));
Route::get('shopping-cart', [CartController::class, 'read']);
Route::post('add-to-cart/{product}', [CartController::class, 'add']);
Route::get('products', [ProductController::class, 'index']);
Route::get('product/{slug}', [ProductController::class, 'select']);
Route::get('checkout', [CartController::class, 'checkout']);
