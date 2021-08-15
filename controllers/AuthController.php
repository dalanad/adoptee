<?php

class AuthController extends Controller
{

    function signin()
    {
        View::render("auth/sign_in");
    }

    function organizationRegistration()
    {
        View::render("auth/sign_up_organization");
    }

    public function process_register_organization()
    {
        Organization::createOrganization($_POST);
        User::createUser($_POST["email"], $_POST["password"], $_POST["name"], $_POST["telephone"]);
    }
}
