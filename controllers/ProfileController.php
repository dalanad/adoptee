<?php

class ProfileController extends Controller
{

    // public function __construct() 
    // {
    //     $this->isLoggedIn(["user"]);
    // }

    function user_profile()
    {
        $id = ["active" => "update_profile", "user_id" => Crypto::encrypt($_SESSION['user']['user_id'])];
        View::render("auth/profile/user_profile", $id);
    }

    function update_profile()
    {
        $data = ["active" => "update_profile"];
        View::render("auth/profile/user_profile", $data);
        if (isset($_POST['submit'])) {
            User::updateProfileData($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address']);
        }
    }

    static function change_password()
    {
        $data = ["active" => "change_password"];
        View::render("auth/profile/user_profile", $data);
    }

    static function notifications()
    {
        $data = ["active" => "notifications", "notifications" => User::getNotifications($_SESSION['user']['user_id'], 200)];
        View::render("auth/profile/user_profile", $data); //backend not connected
    }

    static function consultations()
    {
        $user = new User;
        $consultations = $user->getUpcomingConsultations($_SESSION['user']['user_id']);
        $data = ["active" => "consultations", "consultations" => $consultations];
        View::render("auth/profile/user_profile", $data);
    }

    static function adoptions()
    {
        $user = new User;
        $updates = Adoptions::getUpdates($_SESSION['user']['user_id']);
        $adoptions = $user->getAdoptions($_SESSION['user']['user_id']);
        $data = ["active" => "adoptions", "adoptions" => $adoptions, "updates" => $updates];
        View::render("auth/profile/user_profile", $data);
    }

    static function rescues()
    {
        $report = new ReportRescue;
        $data = ["active" => "rescues", "rescues" => $report->getRescuedPets($_SESSION['user']['user_id'])];
        View::render("auth/profile/user_profile", $data);
    }

    static function my_pets()
    {
        $user = new User;
        $petdata = $user->getUserPets($_SESSION['user']['user_id']);
        for ($i = 0; $i < sizeof($petdata); $i++) {
            $petdata[$i]["consultdata"] = Consultation::getPetConsultation($petdata[$i]['animal_id']);
        }
        $data = [
            "active" => "my_pets",
            "petdata" => $petdata,
        ];
        View::render("auth/profile/user_profile", $data);
    }

    function add_pet()
    {
        $vacc_proof =  image::multi("vacc_proof");
        $photo =  image::single("photo");
        
        $_POST['anti_rabies']?? '';
        $_POST['parvo']?? '';
        $_POST['dhl']?? '';
        $_POST['tricat']?? '';
        $_POST['anti_rabies_booster']?? '';
        $_POST['parvo_booster']?? '';
        $_POST['dhl_booster']?? '';
        $_POST['tricat_booster']?? '';
        $dewormed = isset($_POST['dewormed'])? '1':'0';
        Adoptions::addNewPet($_POST['name'],$_POST['type'],$_POST['gender'],$_POST['dob'],$_POST['color'],$_POST['anti_rabies'],$_POST['parvo'],$_POST['dhl'],$_POST['tricat'],$_POST['anti_rabies_booster'],$_POST['parvo_booster'],$_POST['dhl_booster'],$_POST['tricat_booster'],$dewormed,$photo,$vacc_proof,$_SESSION['user']['user_id']);
        $this->redirect("/Profile/my_pets");
    }

    static function delete_pet()
    {
        User::deletePet($_POST['delete']);
        self::my_pets();
    }

    static function sponsorships()
    {
        $data = [
            "active" => "sponsorships",
            "subscriptions" => User::getSubscriptions()
        ];
        View::render("auth/profile/user_profile", $data);
    }

    static function payments()
    {
        $data = ["active" => "payments"];
        View::render("auth/profile/user_profile", $data); //backend not connected
    }
}
