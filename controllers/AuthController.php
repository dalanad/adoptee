<?php


class AuthController extends Controller
{

    function signin()
    {
        View::render("auth/sign_in");
    }

    function sign_up()
    {
        View::render("auth/sign_up");
    }

    function process_sign_up()
    {
        User::createUser($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address'], $_POST[`password`]);
        header('Location: /auth/verify?email=' . $_POST['email']);
    }

    function organizationRegistration()
    {
        View::render("auth/sign_up_organization");
    }

    public function process_register_organization()
    {
        Organization::createOrganization($_POST);
        User::createUser($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address'], $_POST[`password`]);
    }

    function verify()
    {
        $user = User::findUserByEmail($_GET["email"]);

        if (!isset($_GET["action"])) {

            $email = new EmailService();
            $body = "Dear " . $user["name"] . ", Click the link below to verify your email<br> <a href='http://localhost/auth/verify?email=" . $_GET["email"] . "&action=verify_email'> verify Email </a> ";
            $email->sendMail($user["email"], $user["name"], "Email Verification", $body);

        } else if ($_GET["action"] == "verify_email") {
            // update verified column;

            // header('Location: /adoptionanimals/add_new_animal');
        }

        View::render("auth/user_verification");
    }
}
