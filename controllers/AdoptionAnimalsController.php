<?php

class AdoptionAnimalsController extends Controller{

    function add_new_animal()
    {
        View::render("org/org_dashboard/add_new_animal");
    }

    function process_add_new_animal(){
        
        AdoptionAnimals::createNewAnimal(1, 1, $_POST['type'], $_POST['other'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['description'], $_POST['photo']);
    }  
    
    function animals_for_adoption()
    {
        $data = [
            "active" => "org_adoption_listing",
            "animals"=>AdoptionAnimals::findAnimalsByOrgId(1)
    ];
        View::render("org/dashboard", $data);
    }

    function reported_cases()
    {
        View::render("org/org_dashboard/reported_cases");
    }
}

?>