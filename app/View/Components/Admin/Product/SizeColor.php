<?php

namespace App\View\Components\Admin\Product;

use Illuminate\View\Component;
use App\Models\Color;
use App\Models\Size;

class SizeColor extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $color, $size;
    public function __construct(Color $color, Size $size)

    {

        $this->size = $size;
        $this->color = $color;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $colors = $this->color->where('status', 1)->oldest('name')->get();
        $sizes = $this->size->where('status', 1)->oldest('name')->get();

        return view('components.admin.product.size-color', compact('colors', 'sizes'));
    }
}
