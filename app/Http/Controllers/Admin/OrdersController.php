<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ImageProductOrdersModel;
use App\Models\OrderProducts;
use App\Models\OrderProductsModel;
use App\Models\OrdersModel;
use App\Models\ProductsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    //
    public function index()
    {
        $orders = OrdersModel::orderBy('id', 'desc')->get();
        return view('admin.orders.index', ['data'=>$orders]);
    }

    public function formOrder($id = null)
    {
//        try {
            $categories = CategoriesModel::orderBy('name', 'asc')->get();
            if ($id){
                $model = $id ? OrdersModel::query()->findOrFail($id) : new OrdersModel();
                $products = OrderProductsModel::select('products.*', 'order_products.quantity as qty', 'order_products.price as price_product')
                    ->where('order_id', $id)->join('products', 'products.id', '=', 'product_id')
                    ->orderBy('name', 'asc')->get();
                return view('admin.orders.form_edit', ['model'=>$model, 'categories'=>$categories, 'products'=>$products]);
            } else {
                $model = new OrdersModel();
                $products = [];
                Session::put('productInOrder', $products);
                return view('admin.orders.form', ['model'=>$model, 'categories'=>$categories]);
            }
//        } catch (\Exception $e){
//            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
//        }
    }

    public function saveFormOrder(Request $request)
    {
        try {
            $request_data = $request->all();
            $model = $request_data['id'] ? OrdersModel::query()->findOrFail($request_data['id']) : new OrdersModel();
            $validator = Validator::make($request_data, [
                'recipient_name' => 'required',
                'recipient_phone' => 'required',
                'recipient_address' => 'required',
                'total_price' => 'required',
            ]);
            $message = empty($request_data['id']) ? 'Create order success' : 'Update order success';
            if (empty($request_data['id'])){
                $date = Carbon::today();
                $max = OrdersModel::select(DB::raw('max(cast(substring(order_code, 9) as SIGNED)) AS code_order'))
                    ->whereDate('created_at', $date)
                    ->first();
                $code_order = $max->code_order ? $max->code_order : 0;
                $ma = $code_order ? $code_order : 0;
                if (is_int($ma)){
                    $num = (int)$ma + 1;
                    $ma = '00' . (string) $num;
                    if (strlen($ma) <= 5){
                        $ma = '#'.$date->isoFormat('MMDDYY').'-'.substr($ma, strlen($ma) - 3, 3);
                    } else{
                        $ma = '#'.$date->isoFormat('MMDDYY').'-'.substr($ma, 2);
                    }
                }
                $request_data['order_code'] = $ma;
            }
            if ($validator->fails()){
                $products = [];
                Session::put('productInOrder', $products);
                return redirect()->back()->withInput()->withErrors($validator);
            }
            DB::beginTransaction();
            $model->fill($request_data);
            if ($model->save()){
//                if ($model['order_type'] == 1){
                $list_product = Session::get('productInOrder');
                if ($list_product){
                    foreach ($list_product as $key => $value)
                    {
                        $value['order_id'] = $model['id'];
                        $value['price'] = $value['price_product'];
                        $product_order = new OrderProductsModel();
                        $product_order->fill($value);
                        $product_order->save();

                    }
                    $products = [];
                    Session::put('productInOrder', $products);
                }
//                }
                DB::commit();
                return redirect()->route('orders.index')->with(['success' =>$message]);
            }
            $products = [];
            Session::put('productInOrder', $products);
            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
        } catch (\Exception $e){
            $products = [];
            Session::put('productInOrder', $products);
            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
        }
    }

    public function addProductToOrder(Request $request)
    {
        try {
            $request_data = $request->all();
            $rules = [
                'product_id' => 'required',
                'quantity' => 'required',
                'price_product' => 'required',
                'into_money' => 'required',
            ];
            $validator = Validator::make($request_data, $rules);
            if($validator->fails()) {
                return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
            }
            $product = ProductsModel::query()->findOrFail($request_data['product_id']);
            $request_data['product_name'] = $product['name'];
            $request_data['unit'] = $product['unit'];
            $products = [];
            if(Session::get('productInOrder')){
                $products = Session::get('productInOrder');
            }

            if (!empty($request->id_temp)){
                foreach ($products as $key => $value)
                {
                    if ($value['id_temp'] == $request_data['id_temp'])
                    {
                        unset($products[$key]);
                    }
                }
            } else {
                $id_temp = rand(1,99999999999);
                $request_data['id_temp'] = $id_temp;
            }
            $productAdd = $request_data;
            array_push($products, $productAdd);
            Session::put('productInOrder', $products);
            $list_product = Session::get('productInOrder');
            return Helpers::dataSuccess('Success', $list_product);
        } catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
        }
    }

    public function removeProductOrder(Request $request)
    {
        try {
            $request_data = $request->all();
            if(Session::get('productInOrder')){
                $cart = Session::get('productInOrder');
            }else{
                $cart = collect();
            }
            foreach ($cart as $key => $value)
            {
                if ($value['id_temp'] == $request_data['id'])
                {
                    unset($cart[$key]);
                }
            }
            Session::put('productInOrder', $cart);
            $list_product = Session::get('productInOrder');
            return Helpers::dataSuccess('Success', $list_product);
        } catch (\Exception $e){
            return Helpers::dataError('Sorry an unexpected error occurred. please try again later');
        }
    }

    public function addProductToEditOrder(Request $request)
    {
        try {
            $request_data = $request->all();
            $rules = [
                'product_name' => 'required',
                'product_type' => 'required',
                'quantity' => 'required',
                'extra_charges' => 'required',
            ];
            $validator = Validator::make($request_data, $rules);
            if($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $message = empty($request_data['id']) ? 'Add product success' : 'Update product success';
            $model = empty($request_data['id']) ? new OrderProductsModel() : OrderProductsModel::query()->find($request_data['id']);
            $model->fill($request_data);
            if ($model->save()){
                $total_product_price = OrderProductsModel::where('order_id', $request_data['order_id'])->sum('extra_charges');
                $order = OrdersModel::query()->findOrFail($request_data['order_id']);
                $order['total_price'] = (float)$order['custom_fees'] + (float)$order['provincial_transfer_fee'] + (float)$total_product_price;
                $order->save();
                return redirect()->back()->withInput()->with(['success' =>$message]);
            }
            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
        } catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors(['general' =>'sorry an unexpected error occurred. please try again later']);
        }
    }
}
