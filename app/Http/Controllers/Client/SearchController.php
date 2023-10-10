<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\GetNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    function search(Request $request)
    {
        $key = $request->key;
        if ($key == null) {
            return back();
        }
        $products = Product::search($key)->where('status', 1)->orderBy('name', 'asc')->paginate(12);

        if (auth()->user()) {

            $orders =  Order::search($key)->where('user_id', auth()->user()->id)->paginate(12);
            return view('client.products.search', compact('products', 'orders'));
        }

        return view('client.products.search', compact('products'));
    }


    function newStore(Request $request)
    {
        $data = $request->all();
        try {
            $this->validateStore($data);
            $data['user_id'] = auth()->user()->id;
            GetNew::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Register Success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }
}
