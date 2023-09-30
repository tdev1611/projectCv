<?php

namespace App\Services\Client;

use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductService
{

    protected $product;
    protected $categoryProduct;
    function __construct(Product $product, CategoryProduct   $categoryProduct)
    {
        $this->product = $product;
        $this->categoryProduct = $categoryProduct;
    }

    //index
    function getProductByCategory()
    {
        return $this->categoryProduct->where('status', 1)->whereNull('cat_parent')->get();
    }


    function getProductAll()
    {
        return $this->product->where('status', 1)->oldest('name')->limit(8)->get();
    }
    function productFeatures()
    {
        return $this->product->where('status', 1)->where('features', 1)->oldest('name')->limit(8)->get();
    }




    function findCategory($slug)
    {
        return     $category = $this->categoryProduct->where('slug', $slug)->first();
    }

    //products bycate
    function productByCategory($slug)
    {

        $category = $this->findCategory($slug);
        if (!isset($category)) {
            return abort(404);
        }

        $categoryId = $category->id;
        $sub_categorys =   $this->categoryProduct->where('cat_parent', $categoryId)->get();
        $subCategoryIds = $sub_categorys->pluck('id')->toArray();
        $productByCate = $this->product->where('category_product_id', $categoryId)
            ->orWhereIn('category_product_id', $subCategoryIds)
            ->where('status', 1)->get();
        return $productByCate;
    }

    //detail

    function find($slug)
    {
        $product = $this->product->where('slug', $slug)->where('status', 1)->with('colors', 'sizes')->first();
        if ($product === null) {
            throw new \Exception('Not Found');
        }
        return $product;
    }

    function show($slug)
    {
        return $product = $this->find($slug);
    }
}
