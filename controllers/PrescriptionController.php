<?php

class PrescriptionController extends Controller
{

    public function __construct()
    {
        $_SESSION['prescriptions'] = $_SESSION['prescriptions'] ?? [];
    }

    public function consultation_prescription()
    {
        $consultationId = $_GET['consultation_id'];
        $_SESSION['prescriptions'][$consultationId] = $_SESSION['prescriptions'][$consultationId] ?? ["items" => []];

        View::render('doctor/prescription', [
            "consultationId" => $consultationId,
            "prescription" => $_SESSION['prescriptions'][$consultationId]
        ]);
    }


    public function save_consultation_prescription()
    {
        $consultationId = $_GET['consultation_id'];
        $action = $_POST['action'];
        $_SESSION['prescriptions'][$consultationId]['remarks'] = $_POST['remarks'];
        $_SESSION['prescriptions'][$consultationId]['next_visit_date'] = null;

        if ($action == 'ADD') {
            array_push($_SESSION['prescriptions'][$consultationId]['items'], [
                'name' => $_POST['name'],
                'dose' => $_POST['dose'],
                'direction' => $_POST['direction'],
                'duration' => $_POST['duration'],
            ]);
        //
        } else if ($action == 'SEND') {
            MedicalRecord::sendPrescription($consultationId, $_SESSION['prescriptions'][$consultationId]);
            unset($_SESSION['prescriptions'][$consultationId]);
        // 
        } else if (strpos($action, "REMOVE") >= 0) {
            $index = explode("-", $action);
            array_splice($_SESSION['prescriptions'][$consultationId]['items'], intval($index[1]), 1);
        }
        $this->redirect("consultation_prescription?consultation_id=$consultationId");
    }

    public function  view_prescription()
    {
        $_GET["view"] = true;
        View::render('doctor/prescription', [
            "view" => true,
            "prescription" => MedicalRecord::getPrescriptionById($_GET['id'])
        ]);
    }
}
