<?php

class OrgManagementController extends Controller{

    public function __construct() 
    {
        $this->isLoggedIn(["org_normal","org_admin"]);
    }

    function org_analytics()
    {
        View::render("org/org_dashboard/org_analytics");
    }

    function org_adoption_listing()
    {
        $data = [
            "active" => "org_adoption_listing",

            "animals"=>OrgManagement::findAnimalsByOrgId(1)
    ];
        View::render("org/dashboard", $data);
    }

    function add_new_animal()
    {
        View::render("org/org_dashboard/add_new_animal");
    }

    function process_add_new_animal(){
        $avatar_photo =  image::single("avatar_photo");
        $adoptee_photo =  image::multi("adoptee_photo");

        $color_white = isset($_POST['color_white']) ? true : false;
        $color_grey = isset($_POST['color_grey']) ? true : false;
        $color_orange = isset($_POST['color_orange']) ? true : false;
        $color_brown = isset($_POST['color_brown']) ? true : false;
        $color_black = isset($_POST['color_black']) ? true : false;

        $anti_rabies = isset($_POST['anti_rabies']) ? true : false;
        $dhl = isset($_POST['dhl']) ? true : false;
        $parvo = isset($_POST['parvo']) ? true : false;
        $tricat = isset($_POST['tricat']) ? true : false;
        $anti_rabies_booster = isset($_POST['anti_rabies_booster']) ? true : false;
        $dhl_booster = isset($_POST['dhl_booster']) ? true : false;
        $parvo_booster = isset($_POST['parvo_booster']) ? true : false;
        $tricat_booster = isset($_POST['tricat_booster']) ? true : false;

        $dewormed = isset($_POST['dewormed']) ? true : false;
        
        OrgManagement::createNewAnimal($_SESSION['org_id'], $_POST['name'], $_POST['type'], $_POST['other'], $_POST['gender'], $_POST['dob'], $color_white, $color_grey, $color_orange, $color_brown, $color_black, $_POST['description'], $anti_rabies, $dhl, $parvo, $tricat, $anti_rabies_booster, $dhl_booster, $parvo_booster, $tricat_booster, $dewormed, $avatar_photo, $adoptee_photo);
        

    }  

    function edit_animal_for_adoption(){
        if(isset($_POST['submit'])){OrgManagement::editAnimalData($_POST['status'], $_POST['name'], $_POST['type'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['descripion'], $_POST['photo']);}
    }

    function adoption_requests()
    {
        $data = [
            "active" => "adoption_requests",
            "adoption_requests"=>OrgManagement::findRequestsByOrgId($_SESSION['org_id'])
    ];
        View::render("org/dashboard", $data);
    }

    function accept_adoption_request(){
        OrgManagement::accept_adoption_request($_GET['animal_id']);
        $this->redirect('/OrgManagement/adoption_requests');
    }

    function reject_adoption_request(){
        OrgManagement::reject_adoption_request($_GET['animal_id']);
        $this->redirect('/OrgManagement/adoption_requests');
    }

    function reported_cases()
    {
        $data = [
            "active" => "reported_cases",
            "reported_cases"=>OrgManagement::findReportedCases()
    ];
        View::render("org/dashboard", $data);
    }

    function updateRescueReportStatus()
    {
        $report_id = $_POST['report_id'];
        OrgManagement::updateRescueReportStatus($report_id);
    }

    function org_rescues()
    {
        $data = [
            "active" => "org_rescues",

            "org_rescues"=>OrgManagement::findRescuedAnimalsByOrgId(1)
    ];
        View::render("org/dashboard", $data);
    }

    function add_rescue_update()
    {
        View::render("org/org_dashboard/add_rescue_update");
    }

    function org_donations()
    {
        $data = [
            "active" => "org_donations"

    ];
        View::render("org/dashboard", $data);
    }

    function org_news_events()
    {
        $data = [
            "active" => "org_news_events"

    ];
        View::render("org/dashboard", $data);
    }

    function feedback_list()
    {
        $data = [
            "active" => "feedback_list"
        ];
        View::render("org/dashboard", $data);
    }
    function add_new_event()
    {
        View::render("org/org_dashboard/add_new_event");
    }

}
