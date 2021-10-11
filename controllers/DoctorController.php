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
        $bookings = Consultation::getBookingsCalender($_SESSION["user"]["user_id"], $_GET["start_date"], $_GET["end_date"]);
        View::json($bookings);
    }

    function consult_conference($consultationId)
    {
        $consultation = Consultation::findConsultationById($consultationId);
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
        $consultations = Consultation::findConsultationsByDoctorId($_SESSION["user"]["user_id"]);
        View::json($consultations);
    }

    function get_consultation_by_id()
    {
        $consultationId = $_GET["consultation_id"];
        $consultation = Consultation::findConsultationById($consultationId);
        View::json($consultation);
    }

    function get_messages()
    {
        $consultationId = $_GET["consultation_id"];
        $userId = $_SESSION["user"]["user_id"];
        $messages = Message::getMessagesOfConsultation($consultationId, $userId);
        View::json($messages);
    }

    /** Saves the message and returns the updated messages list */
    function post_message()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $consultationId = $_POST["consultation_id"];
        $message = $_POST["message"];
        $attachments = $_POST["attachments"];
        $userId =  $_SESSION["user"]["user_id"];

        $messages = Message::postMessage($consultationId, $userId, $message, NULL, $attachments);
        View::json($messages);
    }

    #endregion : Medical Advise  

    function consulted_animals()
    {
        $userId =  $_SESSION["user"]["user_id"];
        $filter = [
            "gender" =>  $_GET["gender"] ?? "Any",
            "type" => $_GET["type"] ?? [],
            "search" => $_GET["search"] ?? "",
            "sort" => $_GET["sort"] ?? ["last_consultation  " => "desc"],
            "page" => $_GET["page"] ?? 0,
            "size" => $_GET["size"] ?? 10,
        ];
        $result = Doctor::getConsultedAnimals($userId, $filter);
        $data = [
            "animals" => $result["items"],
            "count" => $result["count"],
            "filter" => $filter
        ];
        View::render("doctor/consulted_animals", $data);
    }


    function animal_history($animal_id)
    {
        $data = [
            "animal" => Animal::getAnimalById($animal_id),
            "owner" => User::findUserById($animal_id),
            "consultations" => Consultation::findConsultationsByPetId($animal_id)
        ];
        View::render("doctor/animal_history", $data);
    }

    #region : Doctor Schedule  

    public function schedule()
    {
        View::render("doctor/schedule");
    }

    public function update_schedule()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        Doctor::updateSchedule($_SESSION["user"]["user_id"], $_POST["schedule"]);
        View::json($_POST["schedule"]);
    }

    public function get_schedule()
    {
        View::json(Doctor::getSchedule($_SESSION["user"]["user_id"]));
    }

    #endregion : Doctor Schedule  

    public function payments()
    {
        View::render("doctor/payments");
    }
}
