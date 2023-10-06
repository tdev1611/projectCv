<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentHistoryController extends Controller
{
    protected $order;

    function __construct(Order $order)
    {
        $this->order = $order;
    }

    function index()
    {
        $orders = $this->order->latest()->where('user_id', auth()->user()->id)->paginate(8);
        return view('client.personal.payment-history', compact('orders'));
    }

    function show($value)
    {

        $order = $this->order->where('code', $value)->where('user_id', auth()->user()->id)->with('discount_code')->first();
        $items_order = json_decode($order->items, true);
        $rece_info = $order->user->address;

        return view('client.personal.payment-history-show', compact('order', 'items_order', 'rece_info'));
    }
}
