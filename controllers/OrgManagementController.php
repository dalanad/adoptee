<?php

class OrgManagementController extends Controller{

    public function __construct() 
    {
        $this->isLoggedIn(["org_normal","org_admin"]);
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
        $photo =  image::multi("photo");
        OrgManagement::createNewAnimal($_SESSION['org_id'], $_POST['name'], $_POST['type'], $_POST['other'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['description'], $photo);
        

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

    function add_new_event()
    {
        View::render("org/org_dashboard/add_new_event");
    }

}
