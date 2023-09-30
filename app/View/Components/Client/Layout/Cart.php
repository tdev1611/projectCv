<?php

namespace App\View\Components\Client\Layout;

use Illuminate\View\Component;
use Gloudemans\Shoppingcart\Facades\Cart as SessionCart;

class Cart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $sessionCart;
    public function __construct(SessionCart $sessionCart)
    {
        $this->sessionCart = $sessionCart;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $items = $this->sessionCart::content();
        return view('components.client.layout.cart', compact('items'));
    }
}
