<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.index');
    }

    public function getData()
    {
        $category = Category::orderBy('id', 'DESC');

        return DataTables::of($category)->addIndexColumn()
            ->editColumn('updated_at', function ($data) {
                return  Carbon::parse($data->updated_at)->format("Y-m-d H:i:s");
            })
            ->editColumn('created_at', function ($data) {
                return  Carbon::parse($data->created_at)->format("Y-m-d H:i:s");
            })
            ->make(true);
    }

    public function addCategory(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validate->fails()) {
            return  response()->json(['success' => false, 'message' => $validate->errors()->first()]);
        }
        DB::beginTransaction();
        try {

            Category::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name' => $request->name,
                    'description' => $request->description
                ]
            );

            DB::commit();
            $message  = (isset($request->id)) ? "Category Updated" : "Category Added";
            return response()->json(['success' => true, 'message' => $message]);
        } catch (Exception $e) {
            DB::rollback();
            \Log::debug($e);
            return  response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getCategory($id)
    {
        return Category::where('id', $id)->first();
    }

    public function deleteCategory($id)
    {
        $category = Category::where('id', $id)->first();
        if (isset($category)) {
            $category->delete();
            return response()->json(['success' => true, 'message' => 'deleted']);
        } else {
            return  response()->json(['success' => false, 'message' => "try again"]);
        }
    }
}
