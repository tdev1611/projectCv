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

    function index()
    {
        $parentCategories = $this->product->getProductByCategory();
        return view('client.products.index', compact('parentCategories'));
    }


    function sort(Request $request)
    {
        $sort = $request->input('sort');

        $products = $this->product->queryProducts();

        if ($sort === 'name_asc') {
            $products->oldest('name');
        } elseif ($sort === 'name_desc') {
            $products->latest('name');
        } elseif ($sort === 'price_desc') {
            $products->latest('price');
        } elseif ($sort === 'price_asc') {
            $products->oldest('price');
        } else {
            $products->oldest('name');
        }
        $products = $products->paginate(12);

        return view('client.products.sort', compact('products'));
    }



    function show($slug)
    {
        try {
            $product = $this->product->show($slug);
            $list_images = json_decode($product->list_image, true);

            $category = $this->category->where('id', $product->category_product_id)->with('products')->first();
            $productsRelate = $category->products->where('slug', '!=', $slug);
            return view('client.products.show', compact('category', 'product', 'list_images', 'productsRelate'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }



    function showProducts($slug)
    {
        try {
            $category = $this->product->findCategory($slug);
            $products = $this->product->productByCategory($slug);
            return view('client.products.byCategory', compact('products', 'category'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    function sortByCate(Request $request)
    {
        $slug = $request->route('slug');
        $category = $this->product->findCategory($slug);
        $products = $this->product->softProduct($slug);

        $sort = $request->input('sort');

        if ($sort === 'name_asc') {
            $products->oldest('name');
        } elseif ($sort === 'name_desc') {
            $products->latest('name');
        } elseif ($sort === 'price_desc') {
            $products->latest('price');
        } elseif ($sort === 'price_asc') {
            $products->oldest('price');
        } else {
            $products->oldest('name');
        }
        $products = $products->paginate(12);

        return view('client.products.sort-product-by-category', compact('products', 'category'));
    }
}
