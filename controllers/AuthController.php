<?php

class AuthController extends Controller
{

    function sign_in()
    {
        View::render("auth/sign_in");
    }

    function process_sign_in()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = User::findUserByEmail($email);

            // check email/ telephone verified ? else send to verification

            if ($user['email_verified'] == 0 || $user['telephone-verified'] == 0) {
                //
            }

            if (Crypto::verify($password, $user["password"])) {
                // todo : identify user
                $_SESSION['user'] =  $user;
                $this->redirect("/");
            } else {
                $this->redirect("/auth/sign_in?error=true");
            }
        } catch (Exception $e) {
            $this->redirect("/auth/sign_in?error=true");
        }
    }

    function sign_out()
    {
        session_destroy();
        $this->redirect("/");
    }

    function sign_up()
    {
        View::render("auth/sign_up");
    }

    function process_sign_up()
    {
        if (User::matchPasswords($_POST['password'], $_POST['confirmPassword'])) 
        {
            User::createUser($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address'], $_POST['password']);
            $this->redirect('/auth/verify?email=' . $_POST['email']);
        } else {
            $this->redirect("/auth/sign_up?error=true");
        }
    }

    function organizationRegistration()
    {
        View::render("auth/sign_up_organization");
    }

    public function process_register_organization()
    {
        Organization::createOrganization($_POST['name'], $_POST['telephone'], $_POST['address_line_1'], $_POST[`address_line_2`], $_POST[`telephone`]);
    }

    function verify()
    {
        $user = User::findUserByEmail($_GET["email"]);

        if (!isset($_GET["action"])) {
            $email = new EmailService();
            $token = Crypto::encrypt($user["email"]);
            $body = "Dear " . $user["name"] . ", Click the link below to verify your email<br> <a href='http://localhost/auth/verify?email=" . $_GET["email"] . "&action=verify_email&token=$token'> Verify Email </a> ";
            $email->sendMail($user["email"], $user["name"], "Email Verification", $body);
            
        } else if ($_GET["action"] == "verify_email"&&  $user["email"] == Crypto::decrypt($_GET["token"])) {
            // update verified column;
            User::verifyEmail($user["email"]);
            // header('Location: /adoptionanimals/add_new_animal');
        }

        View::render("auth/user_verification");
    }

    function change_password()
    {
        $user = $_SESSION['user'];
        if (Crypto::verify($_POST['current'], $user["password"])) {

            if (User::matchPasswords($_POST['new'], $_POST['confirm'])) {
                User::changePassword($user, $_POST['new']);
                $this->redirect("/auth/profile/change_password");
            }
        }
    }

    function request_link()
    {
        View::render("auth/password_reset/request_link.php");
    }

    function process_request_link()
    {
        $user = User::findUserByEmail($_POST["email"]);

            $email = new EmailService();
            $body = "Dear " . $user["name"] . ", Click the link below to reset your password<br> <a href='http://localhost/auth/set_password?email=" . $_GET["email"] . "'> Reset Password </a> ";
            $email->sendMail($user["email"], $user["name"], "Reset Password", $body);
            $this->redirect("/auth/password_reset/request_link?sent=true");

    }

    function set_password()
    {
        View::render("auth/password_reset/set_password.php");
    }

    function proces_set_password()
    {
        $user = User::findUserByEmail($_GET["email"]);

        if (User::matchPasswords($_POST['pass1'], $_POST['pass2'])) {
            User::resetPassword($user, $_POST['pass1']);
        }
    }
}
