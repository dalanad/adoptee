<?php

class AuthController extends Controller
{

    function signin()
    {
        View::render("auth/sign_in");
    }

    function organizationRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_GET["step"] == "2") {
                Organization::createOrganization($_POST);
            }

            if ($_GET["step"] == "3") {
                User::createUser($_POST["email"], $_POST["password"], $_POST["name"], $_POST["telephone"]);
            }
        }

        View::render("auth/sign_up_organization");
    }
}
