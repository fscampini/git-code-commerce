<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Cart;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        if(!Session::has('cart')){
            Session::set('cart', $this->cart);
        }

        return view('store.cart', ['cart' =>Session::get('cart')]);
    }

    public function add($id)
    {

        $cart = $this->getCart();

        $product = Product::find($id);
        $cart->add($id, $product->name, $product->price);

        Session::set('cart', $cart);

        return redirect()->route('cart');

    }

    public function destroy($id)
    {

        $cart = $this->getCart();

        $cart->remove($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');

    }

    public function update($id, $quantity, Request $request)
    {
        if ($request->ajax()) {

            $cart = $this->getCart();

            if ($items = $cart->update_quantity($id, $quantity)) {

                Session::set('cart', $cart);

                return response()->json(array(
                    'success' => true,
                    'price'   => number_format($items[$id]['price'] * $quantity, 2, ',', '.'),
                    'total'   => number_format($cart->getTotal(), 2, ',', '.')
                ));
            } else {
                return response()->json(array('success' => false));
            }

        } else {
            return response()->json(array('success' => false));
        }
    }

    /**
     * @return Cart
     */
    private function getCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = $this->cart;
        }

        return $cart;
    }

}
