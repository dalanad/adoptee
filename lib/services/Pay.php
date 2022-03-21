<?php
require __DIR__ . "/../vendor/stripe-php-7.97.0/init.php";
\Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

class Pay
{
    public static function payment($reason, $amount, $success, $cancel, $ref = null)
    {
        $checkout_session = \Stripe\Checkout\Session::create([
            'client_reference_id' => "$ref",
            'metadata' => ['user_id' => $_SESSION["user"]["user_id"]],
            'customer_email' =>  $_SESSION["user"]["email"],
            'submit_type' => 'pay',
            'line_items' => [[
                'price_data' => [
                    "currency" => "lkr",
                    "product_data" => [
                        "name" => $reason
                    ],
                    "unit_amount" => $amount
                ],
                'quantity' => 1,
            ]],
            'payment_method_types' => [
                'card',
            ],
            'mode' => 'payment',
            'success_url' => Config::get('domain') . "$success?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => Config::get('domain') . $cancel,
        ]);

        return $checkout_session->url;
    }

    public static function subscribe($reason, $amount, $success, $cancel, $subscription_id)
    {

        // todo : fetch subscription Info & set recurring Period
        $checkout_session = \Stripe\Checkout\Session::create([
            'client_reference_id' => "$subscription_id",
            'metadata' => ['user_id' => $_SESSION["user"]["user_id"]],
            'customer_email' =>  $_SESSION["user"]["email"],
            'line_items' => [[
                'price_data' => [
                    "currency" => "lkr",
                    "recurring" => [
                        "interval" => "month"
                    ],
                    "product_data" => [
                        "name" => $reason
                    ],
                    "unit_amount" => $amount
                ],
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => Config::get('domain') . "$success?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => Config::get('domain') . $cancel,
        ]);

        return $checkout_session->url;
    }

    public function unsubscribe($subscription_id)
    {
        # code...
    }

    public static function refundPayment($session_id)
    {
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        \Stripe\Refund::create([
            'payment_intent' => $session['payment_intent']
        ]);
    }
}
