<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\GetNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    //

    function search(Request $request)
    {
    
        $key = $request->key;

        $products = Product::search($key)->where('status', 1)->orderBy('name', 'asc')->paginate(12);
        return response()->json([
            'succeed' => true,
            'data'
        ]);
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
