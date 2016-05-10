<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;
use PHPSC\PagSeguro\Items\Item;

// para Buscas
use PHPSC\PagSeguro\Purchases\Transactions\Locator;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;


class CheckoutController extends Controller
{

    public function place(Order $orderModel, OrderItem $orderItem, CheckoutService $checkoutService)
    {

        if (!Session::has('cart')){
            return false;
        }

        $cart = Session::get('cart');

        if ($cart->getTotal() > 0){

            $checkout = $checkoutService->createCheckoutBuilder();
            $order = $orderModel->create(['user_id'=> Auth::user()->id, 'total'=> $cart->getTotal()]);

            foreach($cart->all() as $k=>$item ){
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, ".","") , $item['qtd']));
                $order->items()->create(['product_id'=>$k, 'price'=>$item['price'], 'qtd'=>$item['qtd']]);
            }

            $cart->clear();
            event(new CheckoutEvent(Auth::user(), $order));
            $response = $checkoutService->checkout($checkout->getCheckout());

            // Salva o Código do PagSeguro na tabela de ordens.
            $order->ps_code = $response->getCode();
            $order->save();
            return redirect($response->getRedirectionUrl());

        }

        $categories = Category::all();

        return view('store.checkout', ['cart' => 'empty', 'categories' => $categories]);
    }

    public function test(CheckoutService $checkoutService)
    {
        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        dd($response->getCode());

        return redirect($response->getRedirectionUrl());
    }

    public function test_search(Credentials $credentials)
    {
        try {

            $service = new Locator($credentials); // Cria instância do serviço de localização de transações

            $transaction = $service->getByCode('2B2477CB-62F3-447D-BF74-11B6F9906FD4');

            dd($transaction); // Exibe na tela a transação
        } catch (Exception $error) { // Caso ocorreu algum erro
            echo $error->getMessage(); // Exibe na tela a mensagem de erro
        }
    }
}
