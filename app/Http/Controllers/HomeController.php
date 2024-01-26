<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::with(['category','images']);
        if (isset($request->category) && !empty($request->category)) {
            $products->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->input('category'));
            });
        }

        $products = $products->paginate(10);

        // $products = Product::with(['images','category'])->get();
        return view('home',[
            'products' => $products,
            'categories' => Category::cursor(),
        ]);
    }
}
