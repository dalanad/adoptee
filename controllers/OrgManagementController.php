<?php

class OrgManagementController extends Controller{

    public function __construct() 
    {
        $this->isLoggedIn(["org_normal","org_admin"]);
    }

    function org_analytics()
    {
        View::render("org/dashboard",["active"=>"org_analytics"]);
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
        $vacc_proof =  image::multi("vacc_proof");
        $avatar_photo =  image::single("avatar_photo");
        $adoptee_photo =  image::multi("adoptee_photo");

        
        OrgManagement::createNewAnimal($_SESSION['org_id'], $_POST['name'], $_POST['type'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['description'], $_POST['anti_rabies'], $_POST['dhl'], $_POST['parvo'], $_POST['tricat'], $_POST['anti_rabies_booster'], $_POST['dhl_booster'], $_POST['parvo_booster'], $_POST['tricat_booster'], $_POST['dewormed'], $vacc_proof, $avatar_photo, $adoptee_photo);
        $this->redirect('/OrgManagement/org_adoption_listing');

    }  

    function edit_animal_for_adoption(){
        if(isset($_POST['submit'])){OrgManagement::editAnimalData($_POST['status'], $_POST['name'], $_POST['type'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['descripion'], $_POST['photos']);}
    }

    function delete_animal(){
        OrgManagement::delete_animal($_GET['animal_id']);
        $this->redirect('/OrgManagement/org_adoption_listing');
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
        OrgManagement::accept_adoption_request($_GET['animal_id'],$_GET['user_id']);
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

    function rescue_animal()
    {
        $report_id = $_POST['report_id'];
        $type = $_POST['type'];
        OrgManagement::rescue_animal($report_id, $type);
    }

    function org_rescues()
    {
        $data = [
            "active" => "org_rescues",

            "org_rescues"=>OrgManagement::findRescuedAnimalsByOrgId()
    ];
        View::render("org/dashboard", $data);
    }

    function add_rescue_update()
    {
        View::render("org/org_dashboard/add_rescue_update");

        $photos =  image::multi("photos");
        
        OrgManagement::add_rescue_update($_SESSION['report_id'], $_POST['description'], $photos);
        
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
            "active" => "org_news_events",
            "org_news_events"=>OrgManagement::findOrgContentByOrgId()
    ];
        View::render("org/dashboard", $data);
    }

    function feedback_list()
    {
        $data = [
            "active" => "feedback_list",
            "feedback" => Organization::getAllFeedback($_SESSION['org_id'])
        ];
        View::render("org/dashboard", $data);
    }

    function acknowledge_feedback()
    {
        Organization::acknowledgeFeedback($_SESSION['org_id'],$_GET["user_id"],$_GET["time"]);
        $this->redirect("feedback_list");
    }

    function add_new_event()
    {
        View::render("org/org_dashboard/add_new_event");

        $photos =  image::multi("photos");
        
        OrgManagement::add_new_event($_SESSION['org_id'], $_POST['heading'], $_POST['description'], $photos);
    }

    function merch_orders()
    {
        $data = [
            "active" => "merch_orders"
        ];
        View::render("org/dashboard", $data);
    }

    function animals_report()
    {
        View::render("org/org_dashboard/animals_report");
        
    }
}
