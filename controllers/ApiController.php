<?php
class ApiController extends Controller
{
    public function __construct()
    {
        $this->isLoggedIn(["doctor", "reg_user"]);
    }

    function get_consultations()
    {
        $consultations = Consultation::findConsultationsByDoctorId($_SESSION["user"]["user_id"],$_GET["type"],$_GET["search"]);
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
        $messages = Message::getMessagesOfConsultation($consultationId, $_SESSION["user"]["user_id"]);
        View::json($messages);
    }

    /** Saves the message and returns the updated messages list */
    function post_message()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $consultationId = $_POST["consultation_id"];
        $message = $_POST["message"];
        $attachments = $_POST["attachments"];

        $messages = Message::postMessage($consultationId, $_SESSION["user"]["user_id"], $message, NULL, $attachments);
        View::json($messages);
    }

    public function complete_consultation()
    {
        $consultationId = $_POST["consultation_id"];
        if (isset($_POST["rating"])) {
            Consultation::complete_user($consultationId, $_POST["rating"]);
        } else {
            Consultation::complete_doctor($consultationId,5);
        }
        $this->redirect($_POST["return_url"]);
    }
}
