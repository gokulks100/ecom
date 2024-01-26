<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected $user_id;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user()->id;
            return $next($request);
        });
    }

    public function index()
    {
        $cart = Cart::with(['product'=>function($data){
            $data->with(['images']);

        }])->where('user_id', $this->user_id)->get();

        return view('carts.index',
            [
                'carts' => $cart
            ]
        );
    }

    public function addCart(Request $request)
    {
        DB::beginTransaction();
        try {
            $cart = Cart::where('product_id', $request->product_id)->where('user_id', $this->user_id)->first();
            if ($cart) {
                return redirect('/')->with('message', 'Already added');
            } else {
                $cart = new cart();
                $cart->product_id = $request->product_id;
                $cart->user_id = $this->user_id;
                $cart->save();
            }
            DB::commit();
            return redirect('/')->with('message', 'Added to cart');
        } catch (Exception $e) {
            DB::rollback();
            \Log::debug($e);
            return redirect('/')->with('message', 'try again');
        }
    }

    public function deletCartItem(Request $request)
    {
        $cart = Cart::where('id', $request->id)->where('user_id', $this->user_id)->first();
        if (!isset($cart)) {
            return response()->json(['success'=>false]);
        }
        $cart->delete();
        return response()->json(['success'=>true]);
    }
}
