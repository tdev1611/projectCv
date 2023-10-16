<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ProfileService;
use App\Services\Client\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccess;

class OrderController extends Controller
{
    //
    protected $profileService;
    protected $orderService;
    function __construct(ProfileService $profileService, OrderService $orderService)
    {
        $this->profileService = $profileService;
        $this->orderService = $orderService;
    }
    function index()
    {

        $address = $this->profileService->getShippinAddress();
        if (!isset($address)) {
            return redirect()->route("client.address.index");
        }
        $cartItem = $this->orderService->getItems();
        if ($cartItem->isEmpty()) {
            return back()->with('error', 'No cart item');
        }

        $totalCart = $this->orderService->totalCart();
        return view('client.order.index', compact('cartItem', 'totalCart'));
    }


    function store(Request $request)
    {

        try {
            $user = auth()->user();
            $data = $request->all();

            $data['code'] =  'OD-' . rand(10000, 999999);
            $data['user_id'] =  $user->id;
            $data['info_id'] =  $user->address->id;

            // fee shipping
            $totalCart = $this->orderService->totalCart();
            $totalCart > 1000 ? $totalCart -= 10 : $totalCart += 10;

            // code_discount
            $codes =  $this->orderService->getCode();
            $code_discount_id = $request->code_discount_id;
            if ($code_discount_id &&  !in_array($code_discount_id, $codes)) {
                throw new \Exception('Invalid code discount! ');
            }

            if ($code_discount_id &&  in_array($code_discount_id, $codes)) {
                $discount = $this->orderService->findCode($code_discount_id);
                if ($discount->qty < 1) {
                    throw new \Exception('Expired discount code!');
                }
                // qty_discount
                $discount->qty -= 1;
                $discount->save();
                $totalCart -= $discount->amount;
                $data['code_discount_id'] = $discount->id;
            }
            $data['total'] =  $totalCart;
            $data['items'] =  $this->orderService->getItems();

            // minusQtyProduct
            $this->minusQtyProduct($data['items']);

            $order =  $this->orderService->create($data);

            Mail::to($user->address->email)->send(new OrderSuccess($order));
            // destroy Items
            $this->orderService->destroyCartDb();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Order completed'
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }



    function minusQtyProduct($data)
    {
        foreach ($data as $item) {
            $product =  $item->product;
            $product->qty -= $item->qty;
            $product->save();
        }
    }

    // thanks order
    function thank()
    {
        $order = $this->orderService->getOrder();
        // items ordered
        $items_order = json_decode($order->items, true);
        $rece_info = $order->user->address;

        return view('client.order.thank', compact('order', 'rece_info', 'items_order'));
    }
}
