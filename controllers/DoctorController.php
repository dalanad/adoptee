<?php

class DoctorController extends Controller
{

    function index()
    {
        $this->redirect("/doctor/home");
    }
    function register()
    {

        View::render("auth/sign_up_doctor");
    }

    function process_registration()
    {
        try {

            $errors = [];

            $name = $_POST["name"];
            $email = is_email($_POST["email"], $errors);
            $reg_no = $_POST["reg_no"];
            $address = $_POST["address"];
            $password = $_POST["password"];
            $telephone = $_POST["telephone"];
            $telephone_fixed = $_POST["telephone_fixed"];
            $credentials = $_POST["credentials"];

            $proofImage =  new Image("proof_image");

            if (sizeof($errors) > 0) {
                $_SESSION['form_errors'] = $errors;
                $this->redirect("/doctor/register");
            }

            BaseModel::beginTransaction();
            $userId = User::createUser($name, $email, $telephone, $address, $password);
            Doctor::createDoctor($userId, $reg_no, $credentials, $telephone_fixed, $proofImage);
            BaseModel::commit();

            $this->redirect("/auth/verify?email=$email");
        } catch (PDOException $e) {

            BaseModel::rollBack();

            if ($e->getCode() == 23000) {

                $_SESSION['form_errors'] = array("Email Already Registered");
                $this->redirect("/doctor/register");
            } else {
                throw $e;
            }
        }
    }

    function home()
    {
        View::render("doctor/home");
    }

    #region : Live Consultations 

    function live_consultation()
    {
        View::render("doctor/live_consultation");
    }

    function get_live_bookings()
    {
        $start_date = $_GET["start_date"];
        $end_date = $_GET["end_date"];
        assert(isset($start_date) && isset($end_date) && $start_date != "" && $end_date != "");
        $bookings = Consultation::getBookingsCalender($_SESSION["user"]["user_id"], $start_date, $end_date);
        View::json($bookings);
    }

    function consult_conference()
    {
        View::render("doctor/consult_conference");
    }

    #endregion  : Live Consultations  

    #region : Medical Advise
    function medical_advise()
    {
        View::render("doctor/medical_advise");
    }

    function get_consultations()
    {
        $consultations = Consultation::getConsultations($_SESSION["user"]["user_id"]);
        View::json($consultations);
    }

    function get_consultation_by_id()
    {
        $consultationId = $_GET["consultation_id"];
        assert(isset($consultationId) && $consultationId != "");
        $consultation = Consultation::getConsultationById($consultationId);
        View::json($consultation);
    }

    function get_messages()
    {
        $consultationId = $_GET["consultation_id"];
        $userId = $_SESSION["user"]["user_id"];
        assert(isset($consultationId) && $consultationId != "");
        $messages = Message::getMessagesOfConsultation($consultationId, $userId);
        View::json($messages);
    }

    public function test_msg()
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache'); // recommended to prevent caching of event data.
        session_write_close();
        function sendMsg($msg)
        {
            echo "data: $msg" . PHP_EOL;
            echo PHP_EOL;
            ob_flush();
            flush();
        }
        $i = 0;
        while ($i != 100) {
            // check whether Apple's stock price has changed
            // e.g., by querying a database, or calling a web service
            // if it HAS changed, sendMsg with new price to client
            sendMsg(time());
            // otherwise, do nothing (until next loop)
            sleep(1); // wait n seconds until checking again
            $i++;
        }
    }

    /** Saves the message and returns the updated messages list */
    function post_message()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $consultationId = $_POST["consultation_id"];
        $message = $_POST["message"];
        $userId =  $_SESSION["user"]["user_id"];

        assert(isset($consultationId) && $consultationId != "");

        $messages = Message::postMessage($consultationId, $userId, $message);
        View::json($messages);
    }
    #endregion : Medical Advise  

    function consulted_animals()
    {
        $userId =  $_SESSION["user"]["user_id"];
        View::render("doctor/consulted_animals", ["animals" => Doctor::getConsultedAnimals($userId)]);
    }

    #region : Doctor Schedule  

    public function schedule()
    {
        View::render("doctor/schedule");
    }

    public function update_schedule()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        Doctor::updateSchedule($_SESSION["user"]["id"], $_POST["schedule"]);
        View::json($_POST["schedule"]);
    }

    public function get_schedule()
    {
        View::json(Doctor::getSchedule($_SESSION["user"]["id"]));
    }

    #endregion : Doctor Schedule  

    public function payments()
    {
        View::render("doctor/payments");
    }
}