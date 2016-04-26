<?php

namespace CodeCommerce\Listeners;

use CodeCommerce\Events\CheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Illuminate\Http\Request;


class SendEmailCheckout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        $user = $event->getUser();
        $order = $event->getOrder();

        $this->sendEmailReminder($user, $order);
    }

    public function sendEmailReminder($user, $order)
    {

        Mail::send('emails.order_confirmation', ['user' => $user, 'order' => $order], function ($m) use ($user) {
            $m->from('fscampini.laravel@gmail.com', 'Order Confirmation');

            $m->to($user->email, $user->name)->subject('Order Confirmation');
        });
    }
}
