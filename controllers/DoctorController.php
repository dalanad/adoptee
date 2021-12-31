<?php

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->isLoggedIn(["doctor"]);
        $this->doctor_id = $_SESSION["user"]["user_id"];
    }

    function index()
    {
        $this->redirect("/Doctor/home");
    }

    function home()
    {
        View::render("doctor/home", [
            "monthly" => Doctor::MonthlyConsultationsByType($this->doctor_id),
            "consultations" => Doctor::DailyConsultationsByMode($this->doctor_id),
        ]);
    }

    #region : Live Consultations 

    function live_consultation()
    {
        View::render("doctor/live_consultation");
    }

    function get_live_bookings()
    {
        $bookings = Consultation::getBookingsCalender($this->doctor_id, $_GET["start_date"], $_GET["end_date"]);
        View::json($bookings);
    }

    function consult_conference($consultationId)
    {
        $consultation = Consultation::findConsultationById($consultationId);
        View::render("doctor/consult_conference", ["consultation" => $consultation]);
    }

    function accept_request()
    {
        $consultationId = $_GET["consultation_id"];
        Doctor::accept_consultation_request($this->doctor_id, $consultationId);
        $this->redirect($_SERVER["HTTP_REFERER"]);
    }

    function reject_request()
    {
        $consultationId = $_GET["consultation_id"];
        Doctor::cancel_consultation_request($this->doctor_id, $consultationId);
        $this->redirect($_SERVER["HTTP_REFERER"]);
    }

    #endregion  : Live Consultations  

    #region : Medical Advise
    function medical_advise()
    {
        View::render("doctor/medical_advise");
    }

    #endregion : Medical Advise  

    function consulted_animals()
    {
        $filter = [
            "gender" =>  $_GET["gender"] ?? "Any",
            "type" => $_GET["type"] ?? [],
            "search" => $_GET["search"] ?? "",
            "sort" => $_GET["sort"] ?? ["last_consultation  " => "desc"],
            "page" => $_GET["page"] ?? 0,
            "size" => $_GET["size"] ?? 10,
        ];
        $result = Doctor::getConsultedAnimals($this->doctor_id, $filter);
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
            "consultations" => Consultation::findConsultationsByPetId($animal_id),
            "prescriptions" => MedicalRecord::getPrescriptionsByAnimalId($animal_id)
        ];
        View::render("doctor/animal_history", $data);
    }

    #region : Doctor Schedule  

    public function schedule()
    {
        View::render("doctor/schedule", ["doctor" => Doctor::findByUID($this->doctor_id)[0]]);
    }

    public function update_pricing()
    {
        $live = $_POST["live"];
        $advise = $_POST["advise"];
        Doctor::updateCharges($this->doctor_id, $live, $advise);
        $this->redirect("schedule");
    }

    public function update_schedule()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        Doctor::updateSchedule($this->doctor_id, $_POST["schedule"]);
        View::json($_POST["schedule"]);
    }

    public function get_schedule()
    {
        View::json(Doctor::getSchedule($this->doctor_id));
    }

    #endregion : Doctor Schedule  

    public function payments()
    {
        View::render("doctor/payments", [
            "pay_history" => Doctor::getPaymentHistory($this->doctor_id),
            "balance" => Doctor::getPaymentBalance($this->doctor_id)
        ]);
    }

    public function withdraw()
    {
        $amount = Doctor::getPaymentBalance($this->doctor_id);
        $this->redirect("/lib/vendor/withdrawal_sandbox.php?amount=$amount");
    }

    public function withdraw_callback()
    {
        $amount = $_GET['amount'];
        $txn_id = $_GET["txn_id"];
        $status = $_GET['status'];

        if ($status == 'SUCCESS') {
            Doctor::recordWithdrawal($this->doctor_id, $amount, $txn_id);
            $this->redirect("/Doctor/payments");
        }

        if ($status == 'CANCELED') {
            $this->redirect("/Doctor/payments");
        }

        if ($status == 'ERROR') {
            $this->redirect("/Doctor/payments");
        }
    }
}
