<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\CartService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;
    function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        // !Auth::user() ?   $items = $this->cartService->getSessionCart() : $items = $this->cartService->getItemsDb();
 
        if (!Auth::user()) {
            $items = $this->cartService->getSessionCart();
            return view('client.cart.index', compact('items'));
        }
        $items = $this->cartService->getItemsDb();
        $totalDb = $this->cartService->totalCartDb();
        return view('client.cart.index', compact('items', 'totalDb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            !Auth::user() ? $this->cartService
                ->addSessionCart($request) :
                $this->cartService->addCartDb($request);

            return response()->json([
                'status' => true,
                'messages' => 'Added product successfully to cart',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()) {
            $item = $this->cartService->updateItemSession($request);

            return response()->json([
                'status' => true,
                'message' => 'Updated successfully ' . $item->name,
                'subtotal' =>  number_format($item->subtotal, 0, '.', ',') . '$',
                'total' => $this->cartService->totalSessionCart(),
                'cartCount' => $this->cartService->countSessionCart(),
                'qty' => $item->qty,
            ]);
        }


        $item = $this->cartService->updateItemDb($request);
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully ' . $item->name,
            'subtotal' =>  number_format($item->subtotal, 0, '.', ',') . '$',
            'total' => $this->cartService->totalCartDb(),
            'cartCount' => $this->cartService->cartCountDb(),
            'qty' => $item->qty,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            !Auth::user() ? $this->cartService->removeItemSession() : $this->cartService->removeItemDb();

            return response()->json([
                'status' => true,
                'message' => 'Delete successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }


    // desstroy cart
    function deleleCart()
    {

        try {
            !Auth::user() ? $this->cartService->destroyCartSession() : $this->cartService->destroyCartDb();
            return back()->with('success', 'Successfully deleted Cart');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
