<?php

class DoctorController extends Controller
{

    function index()
    {
        View::render("doctor/home");
    }

    function register()
    {

        View::render("auth/sign_up_doctor");
    }

    function process_registration()
    {
        try {

            User::createUser($_POST["email"], $_POST["password"], $_POST["name"], $_POST["telephone"]);
            Doctor::createDoctor($_POST["email"], $_POST["reg_no"], $_POST["address"], $_POST["credentials"]);

            $this->redirect('/doctor');
        
        } catch (PDOException $e) {

            if ($e->getCode() == 23000) {
                $this->redirect("/doctor/register?error=duplicate&" . http_build_query($_POST));
            };

        }
        
    }
}
