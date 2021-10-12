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

        $payment_link = Pay::payment("Doctor Consultation", 100000, "/Consultation/success");
        $this->redirect($payment_link);
    }

    public function success()
    {

        $this->redirect("/profile/consultations");
        die();

        require __DIR__ . "/../lib/vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);

        echo "<pre>";
        echo json_encode($session, JSON_PRETTY_PRINT);
    }
}
