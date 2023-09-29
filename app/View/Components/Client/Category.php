<?php

namespace App\View\Components\Client;

use Illuminate\View\Component;
use App\Models\CategoryProduct;

class Category extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $category;
    public function __construct(CategoryProduct $categoryProduct)
    {
        $this->category = $categoryProduct;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = $this->category->where('status', 1)->whereNull('cat_parent')->get();
        $renderMenu = $this->renderCategory($categories);
        return view('components.client.category', compact('renderMenu'));
    }



    public function renderCategory($categories)
    {
        $html = '';
        foreach ($categories as $category) {
            $html .= '<li>';
            $html .= '<a href="' . route('client.product.byCategory', ['slug' => $category->slug]) . '" title="">' . $category->name . '</a>';
            if ($category->children->count()) {
                $html .= '<ul class="sub-menu">';
                $html .= $this->renderCategory($category->children);
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        return $html;
    }
}
