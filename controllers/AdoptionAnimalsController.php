<?php

class AdoptionAnimalsController extends Controller{

    function add_new_animal()
    {
        View::render("org/org_dashboard/add_new_animal");
    }

    function process_add_new_animal(){
        AdoptionAnimals::createNewAnimal(1, 1, $_POST['type'], $_POST['other'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['description'], $_POST['photo']);
    }  
    
    function org_adoption_listing()
    {
        $data = [
            "active" => "org_adoption_listing",
            "animals"=>AdoptionAnimals::findAnimalsByOrgId(1)
    ];
        View::render("org/dashboard", $data);
    }

    function adoption_requests()
    {
        $data = [
            "active" => "adoption_requests",
            "adoption_requests"=>AdoptionAnimals::findRequestsByOrgId(1)
    ];
        View::render("org/dashboard", $data);
    }

    function reported_cases()
    {
        $data = [
            "active" => "reported_cases",
            "reported_cases"=>ReportRescue::findReportedCases()
    ];
        View::render("org/dashboard", $data);
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