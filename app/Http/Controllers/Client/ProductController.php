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

            $category = $this->category->where('id', $product->category_product_id)->with('products')->first();
            $productsRelate = $category->products->where('slug', '!=', $slug);
            return view('client.products.show', compact('category','product', 'list_images', 'productsRelate'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }



    function showProducts($slug)
    {
        try {
            $category = $this->product->findCategory($slug);
            $products = $this->product->productByCategory($slug);
            return view('client.products.byCategory', compact('products','category'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
