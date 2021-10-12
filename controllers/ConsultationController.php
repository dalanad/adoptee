<?php
class ConsultationController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            $data = [
                "doctors" => Doctor::getDoctors(),
                "slots" => Doctor::getSlots(1, '2021-09-08'),
                "pets" => User::getUserPets($_SESSION['user']['user_id']),
                "step" => 1
                // "petdata" => isset($_SESSION['existing_pet'])? Animal::getAnimalById($_SESSION['existing_pet']) : ''
            ];

            view::render('public/consultations/consultation_request', $data);
        } else {
            view::render('public/consultations/consultation_request');
        }
    }

    public function consult_advise()
    {
        View::render("public/consultations/consult_advise");
    }

    public function pay()
    {
        require __DIR__ . "/../lib/vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $YOUR_DOMAIN = $protocol . $_SERVER['HTTP_HOST'];

        $checkout_session = \Stripe\Checkout\Session::create([
            'locale' => 'sl',
            'client_reference_id' => 'test_sssssqeqwe',
            'metadata' => ['dalana' => "ee"],
            'customer_email' => 'test@example.com',
            'submit_type' => 'pay',
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
            'success_url' => $YOUR_DOMAIN . '/Consultation/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        $this->redirect($checkout_session->url);
    }

    public function consult_live()
    {
        View::render("public/consultations/consult_live");
    }

    public function create_request()
    {
        if (isset($_SESSION['pet_name'])) {
            Consultation::bookConsultationNewPet($_SESSION['doctor'], $_SESSION['user']['user_id'], $_SESSION['consultation_type'], $_SESSION['date'], $_SESSION['time'], $_SESSION['pet_name'], $_SESSION['gender'], $_SESSION['animal_type'], $_SESSION['dob']);
            unset($_SESSION['pet_name'], $_SESSION['gender'], $_SESSION['animal_type'], $_SESSION['dob']);
        } else {
            Consultation::bookConsultationPet($_SESSION['doctor'], $_SESSION['user']['user_id'], $_SESSION['consultation_type'], $_SESSION['date'], $_SESSION['time'], $_SESSION['existing_pet']);
            unset($_SESSION['existing_pet']);
        }
        unset($_SESSION['doctor'], $_SESSION['consultation_type'], $_SESSION['date'], $_SESSION['time']);
        $this->redirect("/consultation/index");
    }

    public function success()
    {
        require __DIR__ . "/../lib/vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);

        echo "<pre>";
        echo json_encode($session, JSON_PRETTY_PRINT);
    }
}
