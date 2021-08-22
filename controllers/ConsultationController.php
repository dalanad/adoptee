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
}
