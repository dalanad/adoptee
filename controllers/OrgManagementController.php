<?php

class OrgManagementController extends Controller{

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
        OrgManagement::createNewAnimal(1, $_POST['type'], $_POST['other'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['description'], $_POST['photo']);

    }  

    function adoption_requests()
    {
        $data = [
            "active" => "adoption_requests",
            "adoption_requests"=>OrgManagement::findRequestsByOrgId(1)
    ];
        View::render("org/dashboard", $data);
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
}

?>