<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CartAdminController extends Controller
{
    public function index()
    {
        return view('admin.cart.index');
    }

    public function getData()
    {
        $category = Cart::orderBy('id', 'DESC');

        return DataTables::of($category)->addIndexColumn()
            ->addColumn('name',function($data){
                return Product::where('id',$data->product_id)->first()->name ?? "";
            })
            ->addColumn('user_name',function($data){
                return User::where('id',$data->user_id)->first()->name ??"";
            })
            ->editColumn('updated_at', function ($data) {
                return  Carbon::parse($data->updated_at)->format("Y-m-d H:i:s");
            })
            ->editColumn('created_at', function ($data) {
                return  Carbon::parse($data->created_at)->format("Y-m-d H:i:s");
            })
            ->make(true);
    }

}
