<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = ProductsModel::select('products.*', 'categories.name as category')->join('categories', 'categories.id', '=', 'category_id')
            ->orderBy('products.name', 'asc')->get();
        return view('admin.products.index', ['data'=>$data]);
    }

    public function save(Request $request)
    {
        try {
            $request_data = $request->all();
            $validator = Validator::make($request_data, [
                'name' => 'required',
                'unit' => 'required',
                'qty' => 'required',
                'category_id' => 'required',
            ]);
            if ($validator->fails()){
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $model = $request_data['id'] ? ProductsModel::query()->findOrFail($request_data['id']) : new ProductsModel();
            $mes = $request_data['id'] ? 'Updated success!' : 'Created success!';
            $model->fill($request_data);
            if ($model->save()){
                return redirect()->route('products.index')->with(['success' =>$mes]);
            }
            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
        } catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
        }
    }

    public function delete(Request  $request)
    {
        try {
            $request_data = $request->all();
            $model = ProductsModel::query()->findOrFail($request_data['id']);
            if ($model->delete()){
                return Helpers::dataSuccess('Success');
            }
            return Helpers::dataError('sorry an unexpected error occurred. please try again later');
        } catch (\Exception $e){
            return Helpers::dataError('sorry an unexpected error occurred. please try again later');
        }
    }

    public function ajaxListProduct(Request  $request)
    {
        $districts = DB::table("products")
            ->where("category_id", $request->category)
            ->get();
        return response()->json($districts);
    }
}
