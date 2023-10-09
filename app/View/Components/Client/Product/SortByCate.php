<?php

namespace App\View\Components\Client\Product;

use Illuminate\View\Component;
use App\Services\Client\ProductService;
class SortByCate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {   
      
        return view('components.client.product.sort-by-cate');
    }
}
