<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use App\Models\Order;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $ordersProcess = $this->order->where('status', 1)->get()->count();
        $ordersSuccess = $this->order->where('status', 2)->get()->count();
        $ordersFailed = $this->order->where('status', 3)->get()->count();
        return view('components.admin.dashboard',compact('ordersProcess','ordersSuccess','ordersFailed'));
    }
}
