<?php

namespace App\Services\Admin;

use App\Models\Order;

class OrderService
{
    protected $order;

    function __construct(Order $order)
    {
        $this->order = $order;
    }

    function getAll()
    {
        return $this->order->oldest()->with('discount_code', 'user')->get();
    }

    function getOrdersSuccess()
    {
        return $this->order->oldest()->with('discount_code', 'user')->where('status', 2)->get();
    }
    function getOrdersProcess()
    {
        return $this->order->oldest()->with('discount_code', 'user')->where('status', 1)->get();
    }
    function getOrdersFailed()
    {
        return $this->order->oldest()->with('discount_code', 'user')->where('status', 3)->get();
    }



    function find($id)
    {
        $order =  $this->order->find($id);
        if ($order === null) {
            throw new \Exception('Not found order ');
        }
        return $order;
    }




    // update


    function update($id, $data)
    {
        $order = $this->find($id);
        return     $order->update([
            'status' => $data
        ]);
    }


    function delete($id)
    {
        $order = $this->find($id);
        return $order->delete();
    }
}
