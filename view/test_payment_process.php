<?php

require "../lib/vendor/stripe-php-7.87.0/init.php";

\Stripe\Stripe::setApiKey('sk_test_51JBINKEu3mtzXdk1hnpQNEAIMfA93QrzvlckDFM5y6xI0JDLptM8k13RF0MTBhTzDUkZG4lMxli88h54SwKp0VeZ00csMtwzQJ');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'unit_amount' => 2000,
      'product_data' => [
        'name' => 'Stubborn Attachments',
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
