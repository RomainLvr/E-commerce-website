<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = ProductModel::findOrfail($request->productId);

        \Cart::session($request->userId)->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->qte,
            'attributes' => array(
                'image' => $product->getPrimaryImage()->image,
                'discount' => $product->discount,
                'stock' => $product->stock,
            ),
            'conditions' => new CartCondition(array(
                'name' => 'SALE -' . $product->discount . '%',
                'type' => 'tax',
                'value' => '-' . $product->discount . '%',

            )),
        ));

        return response()->json($this->getCartData($request->userId));
    }


    /**
     * Increment the specified resource in storage.
     */
    public function incProduct(Request $request)
    {
        $product = ProductModel::findOrfail($request->productId);
        if ($product->stock > \Cart::session($request->userId)->get($request->productId)->quantity) {
            \Cart::session($request->userId)->update($request->productId, array(
                'quantity' => 1,
            ));
        }


        return response()->json($this->getCartData($request->userId));
    }

    /**
     * Decrement the specified resource in storage.
     */
    public function decProduct(Request $request)
    {
        $product = ProductModel::findOrfail($request->productId);
        \Cart::session($request->userId)->update($request->productId, array(
            'quantity' => -1,
        ));

        return response()->json($this->getCartData($request->userId));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function removeProduct(Request $request)
    {
        $product = ProductModel::findOrfail($request->productId);
        \Cart::session($request->userId)->remove($request->productId);

        return response()->json($this->getCartData($request->userId));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get cart data
     */
    private function getCartData($userID)
    {
        $itemsImages = array();
        foreach (\Cart::session($userID)->getContent() as $item) {
            $itemsImages[$item->id] = asset('storage/images/products/' . $item->attributes->image);
        }
        $itemsLinks = array();
        foreach (\Cart::session($userID)->getContent() as $item) {
            $itemsLinks[$item->id] = route('produit', $item->id);
        }
        $itemsPrices = array();
        foreach (\Cart::session($userID)->getContent() as $item) {
            $itemsPrices[$item->id] = number_format(\Cart::session($userID)->get($item->id)->getPriceSumWithConditions(), 2, ',', ' ');
        }
        $productQuantity = \Cart::session($userID)->get($item->id)->quantity;

        $cart = array(
            'total' => number_format(\Cart::session($userID)->getTotal(), 2, ',', ' '),
            'count' => \Cart::session($userID)->getTotalQuantity(),
            'items' => \Cart::session($userID)->getContent(),
            'itemsImages' => $itemsImages,
            'itemsLinks' => $itemsLinks,
            'itemsPrices' => $itemsPrices,
            'productQuantity' => $productQuantity,
        );

        return $cart;
    }
}
