<?php
class ConsultationController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user'])) {

            $_SESSION['consultation_type'] = $_POST['consultation_type'] ?? "live";

            if (isset($_POST['doctor']) && isset($_POST['date'])) {
                $_SESSION['doctor'] = $_POST['doctor'];
                $_SESSION['date'] = $_POST['date'];
            }

            $data = [
                "doctors" => Doctor::getDoctors(),
                "slots" => ((isset($_POST['doctor']) && isset($_POST['date'])) ? Doctor::getSlots((int)$_POST['doctor'], $_POST['date']) : NULL),
                "pets" => User::getUserPets($_SESSION['user']['user_id']),
                "step" => $_GET['step'] ?? 1,
                // "petdata" => isset($_SESSION['existing_pet'])? Animal::getAnimalById($_SESSION['existing_pet']) : ''
            ];

            if (isset($_POST['step'])) {

                if ($_POST['step'] == "Make Consultation") {
                    $data['step'] = 2;
                    $_SESSION['time'] = $_POST['time'];
                    $_SESSION['consultation_type'] = $_POST['consultation_type'];
                }

                elseif ($_POST['step'] == "Continue") {
                    $data['step'] = 3;
                    if (isset($_POST['existing_pet'])) {
                        $petdata = Animal::getAnimalById($_POST['existing_pet']);
                        $_SESSION['id'] = $petdata['animal_id'];
                        $_SESSION['pet_name'] = $petdata['name'];
                        $_SESSION['gender'] = $petdata['gender'];
                        $_SESSION['animal_type'] = $petdata['type'];
                        $_SESSION['dob'] = $petdata['dob'];
                    }

                    else{
                        $_SESSION['pet_name'] = $_POST['name'];
                        $_SESSION['gender'] = $_POST['gender'];
                        $_SESSION['animal_type'] = $_POST['animal_type'];
                        $_SESSION['dob'] = $_POST['dob'];
                    }
                }
            }
            view::render('public/consultations/consultation_request', $data);
        }
        view::render('public/consultations/consultation_request');
    }

    public function consult_advise($consultation_id)
    {
        $data = ["consultation" => Consultation::findConsultationById($consultation_id)];
        View::render("public/consultations/consult_advise", $data);
    }

    public function consult_live($consultation_id)
    {
        $data = ["consultation" => Consultation::findConsultationById($consultation_id)];
        View::render("public/consultations/consult_live", $data);
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

    public function complete() {
        $consultation = Consultation::findConsultationById($_GET["id"]);
        View::render("doctor/complete_consultation", ["consultation" => $consultation]);
    }


}
