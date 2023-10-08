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
