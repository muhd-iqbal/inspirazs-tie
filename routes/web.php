<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ToyyibpayController;
use App\Http\Controllers\VariableController;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Variable;
use Illuminate\Http\Request;
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

Route::post('ch-method', [OrderController::class, 'ch_pay_method']);
Route::get('about', fn () => view('about'));
Route::get('contact', fn () => view('contact'));
Route::get('shopping-cart', [CartController::class, 'read']);
Route::delete('shopping-cart', [CartController::class, 'destroy']);
Route::post('add-to-cart/{product}', [CartController::class, 'add']);
Route::get('products', [ProductController::class, 'index']);
Route::get('product/{slug}', [ProductController::class, 'select']);
Route::get('checkout', [CartController::class, 'checkout']);
Route::post('checkout', [CartController::class, 'checkout_address']);
Route::get('checkout-confirm', [CartController::class, 'checkout_confirm']);
Route::post('checkout-confirm', [OrderController::class, 'add']);
Route::get('/o/{hash}/{order}', [OrderController::class, 'view']);
Route::get('pay/{order}', [OrderController::class, 'payment']);

Route::get('ss', fn (Request $request) => $request->session()->all());
Route::get('o', fn () => view('admin.orders', ['orders' => Order::all()]));

Route::get('toyyibpay/{order}', [ToyyibpayController::class, 'create'])->name('toyyibpay-create');
Route::get('toyyibpay-status', [ToyyibpayController::class, 'status'])->name('toyyibpay-status');
Route::post('toyyibpay-callback', [ToyyibpayController::class, 'callback'])->name('toyyibpay-callback');

Route::get('admin/variables', fn () => view('admin.vars', ['vars' => Variable::all()]));
Route::post('admin/var', [VariableController::class, 'add']);
Route::post('admin/var/{var}', [VariableController::class, 'update']);

Auth::routes();



Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
    Route::get('/', [HomeController::class, 'index'])->name('admin');
    Route::get('categories', [ProductCategoryController::class, 'index']);
    Route::post('categories', [ProductCategoryController::class, 'add']);
    Route::get('products', [ProductController::class, 'list']);
    Route::post('products', [ProductController::class, 'add']);
    Route::get('product/{product}', [ProductController::class, 'view']);
    Route::patch('product/{product}', [ProductController::class, 'update']);
    Route::post('product/{product}', [ProductController::class, 'add_image']);

});
