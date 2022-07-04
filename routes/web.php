<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductAddonController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ToyyibpayController;
use App\Http\Controllers\VariableController;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slider;
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
    'sliders' => Slider::get(),
]));

Route::post('ch-method', [OrderController::class, 'ch_pay_method']);
Route::get('about', fn () => view('about'));
Route::get('contact', fn () => view('contact'));
Route::get('how-to-order', fn () => view('how-to-order'));

Route::get('shopping-cart', [CartController::class, 'read']);
Route::delete('shopping-cart', [CartController::class, 'destroy']);
Route::delete('shopping-cart/{cart}', [CartController::class, 'remove']);

Route::post('add-to-cart/{product}', [CartController::class, 'add']);
Route::get('products', [ProductController::class, 'index']);
Route::get('product/{slug}', [ProductController::class, 'select']);
Route::get('checkout', [CartController::class, 'checkout']);
Route::post('checkout', [CartController::class, 'checkout_address']);
Route::get('checkout-confirm', [CartController::class, 'checkout_confirm']);
Route::post('checkout-confirm', [OrderController::class, 'add']);
Route::get('/o/{hash}/{order}', [OrderController::class, 'view']);
Route::get('/o/{hash}/{order}/pdf', [OrderController::class, 'createPDF']);
Route::get('/o/{hash}/{order}/{payment}/pdf', [PaymentController::class, 'createPDF']);
Route::post('/o/{hash}/{order}/change-payment-method', [OrderController::class, 'changePaymentMethod']);

Route::get('pay/{order}', [OrderController::class, 'payment']);

Route::get('ss', fn (Request $request) => $request->session()->all());
// Route::get('o', fn () => view('admin.orders', ['orders' => Order::all()]));

Route::get('toyyibpay/{order}', [ToyyibpayController::class, 'create'])->name('toyyibpay-create');
Route::get('toyyibpay-status', [ToyyibpayController::class, 'status'])->name('toyyibpay-status');
Route::post('toyyibpay-callback', [ToyyibpayController::class, 'callback'])->name('toyyibpay-callback');

Route::get('admin/variables', [VariableController::class, 'list']);
Route::post('admin/var', [VariableController::class, 'add']);
Route::post('admin/var/{var}', [VariableController::class, 'update']);

Auth::routes();

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin');
    Route::get('categories', [ProductCategoryController::class, 'index']);
    Route::post('categories', [ProductCategoryController::class, 'add']);
    Route::get('products', [ProductController::class, 'list']);
    Route::post('products', [ProductController::class, 'add']);
    Route::get('product/{product}', [ProductController::class, 'view']);
    Route::get('product/{product}/addon', [ProductAddonController::class, 'view']);
    Route::post('product/{product}/addon', [ProductAddonController::class, 'add']);
    Route::patch('product/{product}/addon/{addon}', [ProductAddonController::class, 'patch']);
    Route::patch('product/{product}', [ProductController::class, 'update']);
    Route::post('product/{product}', [ProductImagesController::class, 'add']);
    Route::delete('product/{product}/{image}', [ProductImagesController::class, 'delete']);
    Route::get('product/{product}/price', [ProductPriceController::class, 'view']);
    Route::post('product/{product}/price', [ProductPriceController::class, 'add']);
    Route::patch('price/{price}', [ProductPriceController::class, 'update']);
    Route::delete('price/{price}', [ProductPriceController::class, 'delete']);
    Route::get('orders', [OrderController::class, 'list_admin']);
    Route::get('order/{order}', [OrderController::class, 'view_admin']);
    Route::post('order/{order}/pay', [PaymentController::class, 'add']);
    Route::delete('order/{order}/{payment}', [PaymentController::class, 'delete']);
    Route::get('sliders', [SliderController::class, 'index']);
    Route::get('slider/{slider}', [SliderController::class, 'view']);
    Route::patch('slider/{slider}', [SliderController::class, 'update']);
    Route::post('order/{order}/pay/{payment}', [PaymentController::class, 'email']);
});

//testing
// Route::get('mail', [MailController::class, 'order_view']);
// Route::get('mail/{order}', [MailController::class, 'order']);
