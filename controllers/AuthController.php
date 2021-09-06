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

            if ($user['email_verified'] == 0 || $user['telephone_verified'] == 0) {
                $this->redirect('/auth/verify?email=' . $user["email"]);
            }

            if (Crypto::verify($password, $user["password"])) {
                $this->sendToHomePage($user);
            } else {
                $this->redirect("/auth/sign_in?error=true");
            }
        } catch (Exception $e) {
            $this->redirect("/auth/sign_in?error=true");
        }
    }

    private function sendToHomePage($user)
    {
        $_SESSION['user'] =  $user;

        $organizationUser = OrganizationUser::findUserByUID($user["user_id"]);
        $doctors = Doctor::findByUID($user["user_id"]);
        if (sizeof($organizationUser) > 0) {
            $_SESSION['org_id'] =  $organizationUser[0]['org_id'];
            $_SESSION['org'] =  Organization::findOrgById($_SESSION['org_id'])[0];
            $_SESSION['user_role'] = strtolower("org_" . $organizationUser[0]['role']);
            $this->redirect("/OrgManagement/org_adoption_listing");
        } else if (sizeof($doctors) > 0) {
            $_SESSION['user_role'] = "doctor";
            $this->redirect("/doctor");
        } else {
            $_SESSION['user_role'] = "reg_user";
            $this->redirect("/");
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
        if (User::matchPasswords($_POST['password'], $_POST['confirmPassword'])) {
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

        if (User::matchPasswords($_POST['password'], $_POST['confirm-password'])) {

            // TODO: insert to org user

            User::createUser($_POST['name'], $_POST['email'], $_POST['telephone'], "", $_POST['password']);
            Organization::createOrganization($_POST['name'], $_POST['telephone'], $_POST['address_line_1'], $_POST['address_line_2'], $_POST['city']);

            $this->redirect('/auth/verify?email=' . $_POST['email']);
        } else {
            $this->redirect("/auth/organizationRegistration?error=true");
        }
    }

    function verify()
    {
        $email = $_GET["email"];
        if (!isset($email)) {
            throw new Exception("Invalid Parameters", 400);
        }

        $user = User::findUserByEmail($email);

        if (!isset($user)) {
            throw new Exception("User with email '$email' not found", 400);
        }

        // if both email & telephone is already verified 
        if ($user['email_verified'] == 1 && $user['telephone_verified'] == 1) {
            throw new Exception("Both User email & telephone is already verified ", 400);
        }

        $status = "";

        if (!isset($_GET["action"]) && $user['email_verified'] == 0) {

            $email = new EmailService();
            $token = Crypto::encrypt($user["email"]);
            $body = "Dear " . $user["name"] . ", Click the link below to verify your email<br> <a href='http://localhost/auth/verify?email=" . $_GET["email"] . "&action=verify_email&token=$token'> Verify Email </a> ";
            $email->sendMail($user["email"], $user["name"], "Email Verification", $body);
            $status = "email_sent";
        } else if (isset($_GET["action"]) && $_GET["action"] == "verify_email" &&  $user["email"] == Crypto::decrypt($_GET["token"])) {

            User::verifyEmail($user["email"]);
            $status = "email_verified";
        } else if (isset($_GET["action"]) && $_GET["action"] == "send_sms") {

            $notification = new EmailService();
            $otp = rand(100000, 999999);
            $_SESSION["otp"] = $otp;

            # $notification->sendSMS("94769972727", "OTP : $otp"); // set $user["telephone"]
            $status = "sms_sent";
        } else if ($_GET["action"] == "validate_sms") {

            if ($_SESSION["otp"] == $_POST['otp']) {
                User::verifySMS($user["email"]); // TODO:
                $status = "sms_verified";
            } else {
                $status = "otp_invalid";
            };
        }

        View::render("auth/user_verification", ["status" =>  $status, "user" => $user]);
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
        View::render("auth/password_reset/request_link");
    }

    function process_request_link()
    {
        $user = User::findUserByEmail($_POST["email"]);

        $email = new EmailService();

        $body = "Dear " . $user["name"] . ", 
        Click the link below to reset your password <br> 
        <a href='http://localhost/auth/set_password?email=" . $user["email"] . "'> Reset Password </a> ";

        $email->sendMail($user["email"], $user["name"], "Reset Password", $body);
        $this->redirect("/auth/request_link?sent=true");
    }

    function set_password()
    {
        View::render("auth/password_reset/set_password");
    }

    function process_set_password()
    {
        $user = User::findUserByEmail($_GET["email"]);

        if (User::matchPasswords($_POST['pass1'], $_POST['pass2'])) {
            User::changePassword($user["email"], $_POST['pass1']);
            $this->redirect("/auth/sign_in");
        }
    }
}
