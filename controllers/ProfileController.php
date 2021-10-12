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
        View::render("auth/profile/user_profile", $data); //backend not connected
    }

    static function notifications()
    {
        $data = ["active" => "notifications"];
        View::render("auth/profile/user_profile", $data); //backend not connected
    }

    static function consultations()
    {                                               //backend not connected
        $user = new User;
        $petdata = $user->getUserPets($_SESSION['user']['user_id']);
        foreach($petdata as $key=>$value){
            $value["consultations"] = Consultation::getUpcomingConsultations($value['animal_id']);
        }
        $data = ["active" => "consultations"];
        View::render("auth/profile/user_profile", $data); 
    }

    static function adoptions()
    {
        $user = new User;
        $data = ["active" => "adoptions", "adoptions" => $user->getAdoptions($_SESSION['user']['user_id'])];
        View::render("auth/profile/user_profile", $data);
    }

    static function rescues()
    {
        $report = new ReportRescue;
        $data = ["active" => "rescues", "data" => $report->getRescuedPets($_SESSION['user']['user_id'])];
        View::render("auth/profile/user_profile", $data);
    }

    static function my_pets()
    {
        $user = new User;
        $petdata = $user->getUserPets($_SESSION['user']['user_id']);
        for($i=0; $i < sizeof($petdata); $i++){
            $petdata[$i]["consultdata"] = Consultation::getConsultationByPet($petdata[$i]['animal_id']);
        }
        $data = [
            "active" => "my_pets",
            "petdata" => $petdata,
        ];
        View::render("auth/profile/user_profile", $data);
    }

    static function sponsorships()
    {
        $data = ["active" => "sponsorships"];
        View::render("auth/profile/user_profile", $data); //backend not connected
    }

    static function payments()
    {
        $data = ["active" => "payments"];
        View::render("auth/profile/user_profile", $data); //backend not connected
    }

    static function add_pet()
    {
    }
}
