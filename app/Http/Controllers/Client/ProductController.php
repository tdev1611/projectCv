<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Services\Client\ProductService;

class ProductController extends Controller
{
    //
    protected $category;
    protected $product;
    function __construct(CategoryProduct $categoryProduct, ProductService $product)
    {
        $this->category = $categoryProduct;
        $this->product = $product;
    }



    function show($slug)
    {
        try {
            $product = $this->product->show($slug);
              $list_images = json_decode($product->list_image, true);
            return view('client.products.show', compact('product', 'list_images'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }



    function showProducts($slug)
    {
        try {
            return $this->product->productByCategory($slug);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
