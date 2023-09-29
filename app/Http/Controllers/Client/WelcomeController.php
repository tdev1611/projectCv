<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Client\ProductService;

class WelcomeController extends Controller
{
    private $product;
    function __construct(ProductService $productService)
    {
        $this->product = $productService;
    }
    function index()
    {
        $parentCategories = $this->product->getProductByCategory();

        $productFreatures = $this->product->productFeatures();
        return view('welcome', compact('productFreatures',  'parentCategories'));
    }
}
