<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.dashboard',[
            'orders' => Order::latest()->paginate(10),
            'order_all' => Order::all(),
            'category_all' => ProductCategory::all(),
            'product_all' => Product::all(),
        ]);
    }
}
