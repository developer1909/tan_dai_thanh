<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = CategoriesModel::orderBy('name', 'asc')->get();
        return view('admin.categories.index', ['data'=>$data]);
    }

    public function save(Request $request)
    {
        try {
            $request_data = $request->all();
            $validator = Validator::make($request_data, [
                'name' => 'required',
            ]);
            if ($validator->fails()){
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $model = $request_data['id'] ? CategoriesModel::query()->findOrFail($request_data['id']) : new CategoriesModel();
            $mes = $request_data['id'] ? 'Updated success!' : 'Created success!';
            $model->fill($request_data);
            if ($model->save()){
                return redirect()->route('categories.index')->with(['success' =>$mes]);
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
            $model = CategoriesModel::query()->findOrFail($request_data['id']);
            if ($model->delete()){
                return Helpers::dataSuccess('Success');
            }
            return Helpers::dataError('sorry an unexpected error occurred. please try again later');
        } catch (\Exception $e){
            return Helpers::dataError('sorry an unexpected error occurred. please try again later');
        }
    }
}
