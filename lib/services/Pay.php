<?php

class Pay
{
    public static function payment($reason, $amount, $success)
    {
        require __DIR__ . "/../vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $YOUR_DOMAIN = $protocol . $_SERVER['HTTP_HOST'];

        $checkout_session = \Stripe\Checkout\Session::create([
            'client_reference_id' => 'test_sssssqeqwe',
            'metadata' => ['dalana' => "ee"],
            'customer_email' => 'test@example.com',
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
            'success_url' => $YOUR_DOMAIN . "$success?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => $YOUR_DOMAIN . '/Consultation',
        ]);

        return $checkout_session->url;
    }
}
