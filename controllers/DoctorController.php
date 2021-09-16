<?php

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->isLoggedIn(["doctor"]);
    }

    function index()
    {
        $this->redirect("/Doctor/home");
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

    function consult_conference($consultationId)
    {
        assert(isset($consultationId));
        $consultation = Consultation::getConsultationById($consultationId);
        View::render("doctor/consult_conference", ["consultation" => $consultation]);
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

    function upload()
    {
        $links = [];
        foreach ($_FILES as $fileName => $value) {
            $uploaded_file = new Image($fileName);
            array_push($links, $uploaded_file->getURL());
        }
        View::json($links);
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
