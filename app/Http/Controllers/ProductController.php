<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductStock;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'categories' => Category::cursor()
        ]);
    }

    public function getData()
    {
        $data = Product::orderBy('id', 'DESC');

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('updated_at', function ($data) {
                return  Carbon::parse($data->updated_at)->format("Y-m-d H:i:s");
            })
            ->editColumn('created_at', function ($data) {
                return  Carbon::parse($data->created_at)->format("Y-m-d H:i:s");
            })
            ->addColumn('category', function ($data) {
                return Category::where('id',$data->category_id)->withTrashed()->first()->name ?? "";
            })
            ->make(true);
    }

    public function addProduct(Request $request)
    {
        // $url = $this->upload("aws", $request->image, '/services');
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'images' => (!isset($request->id)) ? "required" : "",
            'description' => 'required'
        ]);

        if ($validate->fails()) {
            return  response()->json(['success' => false, 'message' => $validate->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $product =   Product::updateOrCreate(
                [
                    'id' => $request->id  ?? null

                ],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category_id' => $request->category,
                    'user_id' => Auth::guard('admin')->user()->id
                ]
            );


            ProductStock::updateOrCreate(
                [
                    'product_id' => $product->id
                ],
                [
                    'count' => $request->stock
                ]
            );

            if (is_array($request->images)) {
                foreach ($request->images as $image) {

                    $filename = $image->getClientOriginalName();
                    $image->move(public_path('images'), $filename);
                    Media::create(
                        [
                            'model_id' => $product->id,
                            'name' => $filename,
                            'url' => $filename,
                            'model_type' => Product::class,
                        ]
                    );
                }
            }


            DB::commit();
            $message  = (isset($request->id)) ? "Product Updated" : "Product Added";
            return response()->json(['success' => true, 'message' => $message]);
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);
            return  response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function getProductById($id)
    {
        return Product::with(['images', 'stock'])->where('id', $id)->first();
    }

    public function delete($id)
    {
        $data = Product::with(['images'])->where('id', $id)->first();
        if (!isset($data)) {
            return response()->json(['success' => false, 'message' => "product not found!"]);
        }
        if (isset($data->image->url)) {
            $this->deleteFile($data->image->url);
        }
        $data->delete();
        return response()->json(['success' => true, 'message' => 'deleted']);
    }

    public function deleteImage(Request $request)
    {
        $media = Media::where('model_id',$request->id)->first();
        if(!isset($media))
        {
            return response()->json(['success' => false, 'message' => "image not found!"]);
        }
        $media->delete();
        return response()->json(['success' => true, 'message' => 'deleted']);
    }

}
