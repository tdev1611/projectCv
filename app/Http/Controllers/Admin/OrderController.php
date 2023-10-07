<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\OrderService;

class OrderController extends Controller
{
    //
    protected $orderService;
    function __construct(OrderService  $orderService)
    {
        $this->orderService = $orderService;
    }

    function index()
    {
        $orders = $this->orderService->getAll();
        return view('admin.orders.index', compact('orders'));
    }

    function show($id)
    {
        $order = $this->orderService->find($id);
        $items =  json_decode($order->items, true);
        return view('admin.orders.show', compact('order', 'items'));
    }


    function update(Request $request, $id)
    {
        try {

            $status = $request->input('status');
            $this->orderService->update($id, $status);
            return response()->json([
                'message' => "Cập nhật trạng thái thành công!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
