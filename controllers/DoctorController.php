<?php

class DoctorController extends Controller
{

    function index()
    {
        $this->redirect("/doctor/home");
    }
    function register()
    {

        View::render("auth/sign_up_doctor");
    }

    function process_registration()
    {
        try {

            $errors = [];

            $name = $_POST["name"];
            $email = is_email($_POST["email"], $errors);
            $reg_no = $_POST["reg_no"];
            $address = $_POST["address"];
            $password = $_POST["password"];
            $telephone = $_POST["telephone"];
            $telephone_fixed = $_POST["telephone_fixed"];
            $credentials = $_POST["credentials"];

            $proofImage =  new Image("proof_image");

            if (sizeof($errors) > 0) {
                $_SESSION['form_errors'] = $errors;
                $this->redirect("/doctor/register");
            }

            BaseModel::beginTransaction();
            $userId = User::createUser($name, $email, $telephone, $address, $password);
            Doctor::createDoctor($userId, $reg_no, $credentials, $telephone_fixed, $proofImage);
            BaseModel::commit();

            $this->redirect("/auth/verify?email=$email");
        } catch (PDOException $e) {

            BaseModel::rollBack();

            if ($e->getCode() == 23000) {

                $_SESSION['form_errors'] = array("Email Already Registered");
                $this->redirect("/doctor/register");
            } else {
                throw $e;
            }
        }
    }

    function home()
    {
        View::render("doctor/home");
    }

    function live_consultation()
    {
        View::render("doctor/live_consultation");
    }

    function medical_advise()
    {
        View::render("doctor/medical_advise");
    }

    function consulted_animals()
    {
        View::render("doctor/consulted_animals");
    }
}
