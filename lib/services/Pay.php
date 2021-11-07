<?php

class Pay
{
    public static function payment($reason, $amount, $success, $cancel)
    {
        require __DIR__ . "/../vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));


        $checkout_session = \Stripe\Checkout\Session::create([
            'client_reference_id' => 'test_sssssqeqwe',
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
}
