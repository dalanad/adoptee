<?php

class DoctorController extends Controller
{

    function index()
    {
        View::render("doctor/home");
    }

    function register()
    {
        $_SESSION['form_errors'] = [];
        View::render("auth/sign_up_doctor");
    }

    function process_registration()
    {
        try {

            $errors = [];

            $email = $_POST['email'];
            $reg_no = $_POST["reg_no"]; // 1234/e/45

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "invalid email address");
            }

            if (!(bool) preg_match("/[0-9+]+/[a-zA-Z]+/[0-9+]/", $reg_no)) {
                array_push($errors, "invalid registration number");
            }

            if (sizeof($errors) > 0) {
                $_SESSION['form_errors'] = $errors;
                $this->redirect("/doctor/register");
            }

            User::createUser($_POST['name'], $email, $_POST['telephone'], $_POST['address'], $_POST[`password`]);
            Doctor::createDoctor($_POST["email"], $_POST["reg_no"], $_POST["address"], $_POST["credentials"]);

            $this->redirect('/doctor');
        } catch (PDOException $e) {

            if ($e->getCode() == 23000) {
                $this->redirect("/doctor/register?error=duplicate&" . http_build_query($_POST));
            };
        }
    }
}
