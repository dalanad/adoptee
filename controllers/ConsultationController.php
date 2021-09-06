<?php
class ConsultationController extends Controller
{
    public function index()
    {
        $data = [
            "doctors" => Doctor::getDoctors()
        ];
        view::render('public/consultations/consultation_request', $data);
    }

    public function consult_advise()
    {
        View::render("public/consultations/consult_advise");
    }

    public function consult_live()
    {
        View::render("public/consultations/consult_live");
    }
}
