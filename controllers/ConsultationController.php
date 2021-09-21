<?php
class ConsultationController extends Controller
{
    public function index()
    {
        $data = [
            "doctors" => Doctor::getDoctors(),
            "slots" => Doctor::getSlots(1, '2021-09-08')
        ];
        view::render('public/consultations/consultation_request', $data);
    }

    public function consult_advise()
    {
        View::render("public/consultations/consult_advise");
    }


    public function pay()
    {
        require __DIR__ . "/../lib/vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $YOUR_DOMAIN = 'http://localhost';

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    "currency" => "lkr",
                    "product_data" => [
                        "name" => "Test doctor"
                    ],
                    "unit_amount" => "150000"
                ],
                'quantity' => 1,
            ]],
            'payment_method_types' => [
                'card',
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        $this->redirect($checkout_session->url);
    }

    public function consult_live()
    {
        View::render("public/consultations/consult_live");
    }
}
