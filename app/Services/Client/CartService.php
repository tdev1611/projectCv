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

    function destroyCartSession()
    {
        return $this->sessionCart::destroy();
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
        if ($request->qty > $product->qty) {
            throw new \Exception('Product quantity is not enough');
        }
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

    function updateItemSession(Request $request)
    {
        $id = $request->rowId;
        $qty = $request->qty;
        //find product
        $product = $this->findProduct($request->id);
        if ($qty > $product->qty) {
            throw new \Exception('Product quantity is not enough');
        }
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
        return  $this->findCartByUserId(auth()->user()->id)->get();
    }
    function totalCartDb()
    {

        return  $this->findCartByUserId(auth()->user()->id)->sum('subtotal');
    }

    function cartCountDb()
    {
        return  $this->findCartByUserId(auth()->user()->id)->sum('qty');
    }

    function findCartByUserId($userId)
    {
        return $this->cart->where('user_id', $userId);
    }

    function findItemByUserId($userId, $rowId)
    {
        return $this->cart->where('user_id', $userId)->where('rowId', $rowId)->first();
    }

    function addCartDb(Request $request)
    {
        $validator = $this->validateStoreCart($request->all());
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        //find product
        $product = $this->findProduct($request->id);
        if ($request->qty > $product->qty) {
            throw new \Exception('Product quantity is not enough');
        }
        //create rowId
        $rowId = md5($request->color . $request->size . $product->id);
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

    function updateItemDb(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;
        $cart = $this->findItemByUserId(auth()->user()->id, $rowId);
        //find product
        $product = $this->findProduct($request->id);
        if ($qty > $product->qty) {
            throw new \Exception('Product quantity is not enough');
        }
        $cart->update([
            'qty' => $qty,
            'subtotal' => $qty * $this->findItemByUserId(auth()->user()->id, $rowId)->price
        ]);
        // $this->cart->where('rowId', $id)->where('user_id', auth()->user()->id)->update([
        //     'qty' => $qty,
        //     'subtotal' => $qty * $this->cart->where('rowId', $id)->first()->price
        // ]);
        return  $cart = $this->findItemByUserId(auth()->user()->id, $rowId);
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
    function destroyCartDb()
    {
        $items =  $this->findCartByUserId(auth()->user()->id)->whereNotNull('id');
        return $items->delete();
    }
}
