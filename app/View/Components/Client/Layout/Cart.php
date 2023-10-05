<?php

namespace App\View\Components\Client\Layout;

use Illuminate\View\Component;
use Gloudemans\Shoppingcart\Facades\Cart as SessionCart;
use App\Models\Cart as CartDb;

class Cart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $sessionCart;
    protected $cartDb;
    public function __construct(SessionCart $sessionCart, CartDb $cartDb)
    {
        $this->sessionCart = $sessionCart;
        $this->cartDb = $cartDb;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        // !auth()->user() ?   $items = $this->sessionCart::content() :  $items = $this->cartDb::all();
        if (!auth()->user()) {
            $items = $this->sessionCart::content();
            return view('components.client.layout.cart', compact('items'));
        }

        $items = $this->cartDb::all();
        $countDb = $this->cartDb->where('user_id', auth()->user()->id)->sum('qty');
        $totalDb = $this->cartDb->where('user_id', auth()->user()->id)->sum('subtotal');
        return view('components.client.layout.cart', compact('items','countDb','totalDb'));
    }
}
