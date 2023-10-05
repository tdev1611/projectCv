<?php

namespace App\Services\Client;

use App\Models\Cart;
use App\Models\CodeDiscount;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderService
{

    private $cart;
    private $code;
    private $order;
    function __construct(Cart $cart, CodeDiscount $code, Order $order)
    {

        $this->cart = $cart;
        $this->code = $code;
        $this->order = $order;
    }

    // order

    function getOrder()
    {
        return $this->order->latest()->where('user_id', auth()->user()->id)->with('user')->first();
    }


    function create($data)
    {
        return $this->order->create($data);
    }
    function destroyCartDb()
    {
        $items =  $this->findCartByUserId()->whereNotNull('id');
        return $items->delete();
    }
    // cart
    function getItems()
    {
        return $this->findCartByUserId()->get();
    }
    function totalCart()
    {

        return  $this->findCartByUserId()->sum('subtotal');
    }


    function findCartByUserId()
    {
        return $this->cart->where('user_id', auth()->user()->id);
    }


    // code

    function getCode()
    {
        return $this->code->where('status', 1)->get()->pluck('code')->toArray();
    }

    function findCode($value)
    {
        return $this->code->where('code', $value)->first();
    }
}
