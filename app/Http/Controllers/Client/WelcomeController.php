<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\ProductService;
use App\Services\Client\WelcomeService;

class WelcomeController extends Controller
{
    private $product;
    private $welcomeService;
    function __construct(ProductService $productService, WelcomeService $welcomeService)
    {
        $this->product = $productService;
        $this->welcomeService = $welcomeService;
    }
    function index()
    {

        $banners = $this->welcomeService->getBanner();
        $notify = $this->welcomeService->getNotify();
        $listCode = $this->welcomeService->getCodeDiscount();

        $parentCategories = $this->product->getProductByCategory();
        $productFreatures = $this->product->productFeatures();
        return view('welcome', compact('productFreatures',  'parentCategories', 'banners', 'notify','listCode'));
    }
}
