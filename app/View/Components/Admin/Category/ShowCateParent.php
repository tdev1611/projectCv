<?php

namespace App\View\Components\Admin\Category;

use Illuminate\View\Component;
use App\Models\CategoryProduct;


class ShowCateParent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = CategoryProduct::where('status', 1)->oldest('prioty')->get();
        return view('components.admin.category.show-cate-parent',compact('categories'));
    }
}
