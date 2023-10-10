<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    function search(Request $request)
    {
        $key = $request->key;

        $products = Product::search($key)->where('status', 1)->orderBy('name', 'asc')->paginate(12);
        return response()->json([
            'succeed' => true,
            'data' => $products
        ]);
    }
}
