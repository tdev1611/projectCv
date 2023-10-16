<?php

namespace App\Services\Admin;


use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\CodeDiscount;
use App\Models\CategoryProduct;


class DashboardService
{

    protected $user, $product,$order;
    protected $codeDiscount;
    protected $categoryProduct;
    function __construct(Order $order, User $user, Product  $product, CodeDiscount $codeDiscount, CategoryProduct $categoryProduct)
    {
        $this->order = $order;
        $this->user = $user;
        $this->product = $product;
        $this->codeDiscount = $codeDiscount;
        $this->categoryProduct = $categoryProduct;
    }




    // orders

    function getOrders(){
        return $this->order->all()->count();
    }


    // 
    function totalUsers()
    {
        return $this->user->all()->count();
    }
    function getUsersActive()
    {
        return $this->user->where('status', 1)->get()->count();
    }
    function getUsersInactive()
    {
        return $this->user->where('status', 2)->get()->count();
    }

    // --------------------------------------------------------


    function getAmountProducts()
    {

        return $this->product->all()->count();
    }

    function getCategories()
    {
        return $this->categoryProduct->where('status', 1)->where('cat_parent',null)->get();
    }


    // --------------------------------------------------------
    function getCodeDiscount()
    {
        return $this->codeDiscount->where('status', 1)->oldest('code')->get();
    }
}
