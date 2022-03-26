<?php

class AuthController extends Controller
{

    function sign_in()
    {
        View::render("auth/sign_in");
    }

    function process_sign_in()
    {
        $email = is_email($_POST['email']);
        $password = $_POST['password'];

        $user = User::findUserByEmail($email);

        if (!isset($user)) {
            $this->redirect("/auth/sign_in?error=true");
        }

        if ($user['email_verified'] == 0 || $user['telephone_verified'] == 0) {
            $this->redirect('/auth/verify?email=' . $user["email"]);
        }

        if (Crypto::verify($password, $user["password"])) {
            $this->sendToHomePage($user);
        } else {
            $this->redirect("/auth/sign_in?error=true");
        }
    }

    private function sendToHomePage($user)
    {
        $_SESSION['user'] =  $user;

        $organizationUser = OrganizationUser::findUserByUID($user["user_id"]);
        $doctors = Doctor::findByUID($user["user_id"]);

        if (sizeof($organizationUser) > 0) {

            if ($organizationUser[0]["status"] == 'DISABLED') {
                $this->redirect("/auth/sign_in?error=true&message=Account Disabled");
                return;
            }

            $_SESSION['org_id'] =  $organizationUser[0]['org_id'];
            $_SESSION['org'] =  Organization::findOrgById($_SESSION['org_id'])[0];
            $_SESSION['user_role'] = strtolower("org_" . $organizationUser[0]['role']);
            $this->redirect("/OrgManagement/org_analytics");
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

            Organization::registerOrganization($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address_line_1'], $_POST['address_line_2'], $_POST['city'], $_POST['password']);
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
            $body = "Dear " . $user["name"] . ", Click the link below to verify your email<br> <a href='" . config::get('domain') . "/auth/verify?email=" . $_GET["email"] . "&action=verify_email&token=$token'> Verify Email </a> ";
            $email->sendMail($user["email"], $user["name"], "Email Verification", $body);
            $status = "email_sent";
        } elseif (isset($_GET["action"]) && $_GET["action"] == "verify_email" &&  $user["email"] == Crypto::decrypt($_GET["token"])) {

            User::verifyEmail($user["email"]);
            $status = "email_verified";
        } elseif (isset($_GET["action"]) && $_GET["action"] == "send_sms") {
            $notification = new EmailService();
            $otp = rand(100000, 999999);
            $_SESSION["otp"] = $otp;
            $notification->sendSMS("94" . (int) $user["telephone"], "Adoptee OTP : $otp");
            $status = "sms_sent";
        } elseif ($_GET["action"] == "validate_sms") {
            if ($_SESSION["otp"] == $_POST['otp']) {
                User::verifySMS($user["email"]);
                $status = "sms_verified";
            } else {
                $status = "otp_invalid";
            };
        }

        View::render("auth/user_verification", ["status" =>  $status, "user" => $user]);
    }

    function verify_email()
    {
        $status = "";
        $email = $_GET['email'];
        $user = User::findUserByEmail($email);

        if (!isset($_GET["action"]) && $user['email_verified'] == 0) {

            $email = new EmailService();
            $token = Crypto::encrypt($user["email"]);
            $body = "Dear " . $user["name"] . ", Click the link below to verify your email<br> <a href='" . config::get('domain') . "/auth/verify_email?email=" . $_GET["email"] . "&action=verify_email&token=$token'> Verify Email </a> ";
            $email->sendMail($user["email"], $user["name"], "Email Verification", $body);
            $status = "email_sent";
            View::render("auth/user_verification", ["status" =>  $status, "user" => $user]);
        }

        else if (isset($_GET["action"]) && $_GET["action"] == "verify_email" &&  $user["email"] == Crypto::decrypt($_GET["token"])) {
            User::verifyEmail($user["email"]);
            $this->redirect("/Profile/user_profile");
        }
    }

    function verify_telephone()
    {
        $status = "";
        $email = $_GET['email'];
        $user = User::findUserByEmail($email);

        if (!isset($_GET["action"]) && $user['telephone_verified'] == 0) {
            $notification = new EmailService();
            $otp = rand(100000, 999999);
            $_SESSION["otp"] = $otp;
            $notification->sendSMS("94" . (int) $user["telephone"], "Adoptee OTP : $otp");
            $status = "sms_sent";
            View::render("auth/user_verification", ["status" =>  $status, "user" => $user]);
        }

        elseif ($_GET["action"] == "validate_sms") {
            if ($_SESSION["otp"] == $_POST['otp']) {
                User::verifySMS($user["email"]);
                $this->redirect("/Profile/user_profile");
            } else {
                $status = "otp_invalid";
                View::render("auth/user_verification", ["status" =>  $status, "user" => $user]);
            };
        }
    }

    function change_password()
    {
        $user = $_SESSION['user'];
        if (Crypto::verify($_POST['current'], $user["password"])) {

            if (User::matchPasswords($_POST['new'], $_POST['confirm'])) {
                User::changePassword($user['email'], $_POST['new']);
                $this->redirect("/profile/change_password?successful=true");
            } else {
                $this->redirect("/profile/change_password?error=nomatch");
            }
        } else {
            $this->redirect("/profile/change_password?error=wrongpassword");
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
        <a href='" . config::get('domain') . "/auth/set_password?email=" . $user["email"] . "'> Reset Password </a> ";

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
        } else {
            $this->redirect("/auth/set_password?error=true");
        }
    }

    function doctor_registration()
    {

        View::render("auth/sign_up_doctor");
    }

    function process_doctor_registration()
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


            $proofImage =  Image::multi("proof_image");

            if (sizeof($errors) > 0) {
                $_SESSION['form_errors'] = $errors;
                $this->redirect("/auth/doctor_registration");
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
                $this->redirect("/auth/doctor_registration");
            } else {
                throw $e;
            }
        }
    }
}
