<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Order;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Support\Facades\Auth;
use PHPSC\PagSeguro\Purchases\Transactions\Locator;

class AccountController extends Controller
{

    public function index()
    {

    }

    public function orders()
    {
        $orders = Auth::user()->orders;

        return view('store.orders', compact('orders'));
    }

    public function all()
    {
        $orders = Order::all();

        return view('store.all_orders', compact('orders'));
    }

    public function update_status($id, $status, Request $request)
    {
        if ($request->ajax()) {

            $order = Order::find($id);
            $order->status = $status;
            $order->save();

            return response()->json(array(
                    'success' => true
            ));

        } else {
            return response()->json(array('success' => false));
        }
    }

    public function update_status_ps(Locator $locator, Request $request)
    {

        $transaction_code = $request->get('ps_code');
        $transaction = $locator->getByCode($transaction_code);
        $orderId = $transaction->getDetails()->getReference();
        $status = $transaction->getDetails()->getStatus();

        $order = Order::find($orderId);
        $order->status = $status;
        $order->save();

        $orders = Order::all();
        return view('store.all_orders', compact('orders'));
    }

}
