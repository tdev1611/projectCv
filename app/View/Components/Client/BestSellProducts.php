<?php

namespace App\View\Components\Client;

use App\Models\Order;
use Illuminate\View\Component;

class BestSellProducts extends Component
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
        $products = Order::select('items')
            ->get()
            ->flatMap(function ($order) {
                return json_decode($order->items, true);
            })
            ->groupBy('product_id')
            ->map(function ($order) {
                return [
                    'product_id' => $order[0]['id'],
                    'name' => $order[0]['name'],
                    'price' => $order[0]['price'],
                    'discount' => $order[0]['product']['discount'],
                    'slug' => $order[0]['product']['slug'],
                    'image' => $order[0]['product']['images'],
                    'total_sold' => collect($order)->sum('qty'),
                ];
            })
            ->sortByDesc('total_sold')
            ->take(6)
            ->values();
        return view('components.client.best-sell-products', compact('products'));
    }
}
