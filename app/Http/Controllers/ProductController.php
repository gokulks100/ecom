<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function getData()
    {
        $data = Product::orderBy('id','DESC');

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('updated_at', function ($data) {
                return  Carbon::parse($data->updated_at)->format("Y-m-d H:i:s");
            })
            ->editColumn('price', function ($data) {
                return "$" . $data->price;
            })
            ->addColumn('action', function () {
                return $this->getActions('service_management');
            })
            // ->editColumn('updated_by', function ($data) {
            //     return Admin::where("id", $data->updated_by)->first()->name ?? "";
            // })
            ->make(true);
    }

    public function addService(Request $request)
    {
        // $url = $this->upload("aws", $request->image, '/services');

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'tax' => 'required',
            'max_members' => 'required',
            'min_members' => 'required',
            'image' => (!isset($request->id)) ? "required|mimes:jpg,jpeg,png" : "",
            'description' => 'required'
        ]);

        if ($validate->fails()) {
            return  response()->json(['success' => false, 'message' => $validate->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $service =   Service::updateOrCreate(
                [
                    'id' => $request->id  ?? null

                ],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'tax' => $request->tax,
                    'min_members' => $request->min_members,
                    'max_members' => $request->max_members,
                    'created_by' => Auth::guard('admin')->user()->id,
                    'updated_by' => Auth::guard('admin')->user()->id,
                    'wheel_taxi' => (isset($request->wheel_taxi)) ? 1 : 0
                ]
            );

            if (isset($request->image) && $request->file('image')) {
                // $img_name = $request->image->getClientOriginalName();
                // $url = $this->upload("aws", $request->image, '/services');
                // $imgname = Helper::imagePathUrl("AWS", $request->image, "/users");
                $img_name = 'services/' . $request->image->getClientOriginalName();
                $this->storePublicFile($img_name, $request->image);
                $url = $this->openPublicFile($img_name);

                Media::updateOrCreate(
                    [
                        'model_id' => $service->id
                    ],
                    [
                        'name' => $img_name,
                        'url' => $url,
                        'model_type' => Service::class,
                    ]
                );
            }
            DB::commit();
            $message  = (isset($request->id)) ? "Service Updated" : "Service Added";
            return response()->json(['success' => true, 'message' => $message]);
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e);
            return  response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function getServiceById($id)
    {
        return Service::with(['image'])->where('id', $id)->first();
    }

    public function delete($id)
    {
        $data = Service::with(['image'])->where('id', $id)->first();
        if (!isset($data)) {
            return response()->json(['success' => false, 'message' => "Service not found!"]);
        }
        if (isset($data->image->url)) {
            $this->deleteFile($data->image->url);
        }
        $data->delete();
        return response()->json(['success' => true, 'message' => 'deleted']);
    }

    public function changeStatus(Request $request)
    {
        $data = Service::where('id', $request->id)->first();
        if (!isset($data)) {
            return response()->json(['success' => false, 'message' => "Service not found!"]);
        }
        $data->is_active =  $request->status;
        $data->save();
        $message = ($request->status == 1) ? "User Actived" : "User Inactived";
        return response()->json(['success' => true, 'message' => $message]);
    }
}
