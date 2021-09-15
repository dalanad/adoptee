<?php
class ConsultationController extends Controller
{
    public function index()
    {
        $data = [
            "doctors" => Doctor::getDoctors(),
            "slots" => Doctor::getSlots(1, '2021-09-08')
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
