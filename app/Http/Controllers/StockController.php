<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    public function index()
    {
        return view('admin.stocks.index');
    }

    public function getData()
    {
        $category = ProductStock::orderBy('id', 'DESC');

        return DataTables::of($category)->addIndexColumn()
            ->addColumn('name',function($data){
                return Product::where('id',$data->product_id)->first()->name ?? "";
            })
            ->editColumn('updated_at', function ($data) {
                return  Carbon::parse($data->updated_at)->format("Y-m-d H:i:s");
            })
            ->editColumn('created_at', function ($data) {
                return  Carbon::parse($data->created_at)->format("Y-m-d H:i:s");
            })
            ->make(true);
    }

    public function updateStock(Request $request)
    {
       $validate = Validator::make($request->all(), [
            'count' => 'required',
        ]);

        if ($validate->fails()) {
            return  response()->json(['success' => false, 'message' => $validate->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $product =  ProductStock::where('id',$request->id)->first();
            $product->count = $request->count;
            $product->save();
            DB::commit();
            $message  = "stock Updated";
            return response()->json(['success' => true, 'message' => $message]);
        } catch (Exception $e) {
            DB::rollback();
            \Log::debug($e);
            return  response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
