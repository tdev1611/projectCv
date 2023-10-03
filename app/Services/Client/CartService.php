<?php

namespace App\Services\Client;

use App\Models\Cart;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart as SessionCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartService
{
    private $sessionCart;
    private $cart;
    function __construct(SessionCart $sessionCart, Cart $cart)
    {
        $this->sessionCart = $sessionCart;
        $this->cart = $cart;
    }

    // cart to session
    function getSessionCart()
    {
        return $this->sessionCart::content();
    }
    function totalSessionCart()
    {
        return $this->sessionCart::total();
    }
    function countSessionCart()
    {
        return $this->sessionCart::count();
    }

    function validateStoreCart($data)
    {
        $validator = Validator::make($data, [
            'id' => 'required|integer',
            'qty' => 'required|integer',
            'color' => 'required|exists:colors,name',
            'size' => 'required|exists:sizes,name',
            'price' => 'required',

        ]);
        return $validator;
    }
    //add cart to session
    function addSessionCart(Request $request)
    {
        $validator = $this->validateStoreCart($request->all());
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        $product = $this->findProduct($request->id);
        $cart = $this->addToCartSession($product, $request->qty, $request->color, $request->size, $request->price);

        return $cart;
    }


    protected function findProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new \Exception('Product not found');
        }
        return $product;
    }
    protected function addToCartSession($product, $qty, $color, $size, $price)
    {
        return $this->sessionCart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $price,
            'options' => [
                'code' => $product->code,
                'image' => $product->images,
                'color' => $color,
                'size' => $size,
                'slug' => $product->slug,
            ]
        ]);
    }

    // / update 

    function update(Request $request)
    {
        $id = $request->rowId;
        $qty = $request->qty;
        $this->sessionCart::update($id, $qty);
        $item = $this->sessionCart::get($id);
        return $item;
    }



    function removeItemSession()
    {
        $rowId = request()->input('rowId');
        $item = $this->sessionCart::content()->where('rowId', $rowId);

        if (!$item->isNotEmpty()) {
            throw new \Exception('Not found Item');
        }
        $this->sessionCart::remove($rowId);
    }

    //cart db
    //---------------------------------------------------------------------------------

    function getItemsDb()
    {
        return $this->cart::all();
    }




    function addCartDb(Request $request)
    {
        $validator = $this->validateStoreCart($request->all());
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        //find product
        $product = $this->findProduct($request->id);
        //create rowId
        $rowId = md5($request->color . $request->size. $product->id);
        $existItem = $this->cart->where('rowId', $rowId)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($existItem) {
            $existItem->qty += $request->qty;
            $existItem->subtotal = $existItem->qty * $product->price;
            return $existItem->save();
        }
        $cart = $this->addToCartDb($product, $rowId, $request->qty, $request->color, $request->size, $request->price);
        return $cart;
    }

    public function addToCartDb($product, $rowId, $qty, $color, $size, $price)
    {
        return $cart = $this->cart::create([
            'rowId' => $rowId,
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
            'name' => $product->name,
            'qty' => $qty,
            'subtotal' => $qty * $price,
            'price' => $price,
            'options' => json_encode([
                'code' => $product->code,
                'image' => $product->images,
                'color' => $color,
                'size' => $size,
                'slug' => $product->slug,
            ])
        ]);
    }



    function removeItemDb()
    {
        $rowId = request()->input('rowId');
        $item = $this->cart->where('rowId', $rowId)->first();
        if (!$item) {
            throw new \Exception('Not found Item');
        }
        return $item->delete();
    }
}
