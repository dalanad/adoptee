<?php

class AdoptionAnimalsController extends Controller{

    function add_new_animal()
    {
        View::render("org/org_dashboard/add_new_animal");
    }

    function process_add_new_animal(){
        AdoptionAnimal::createNewAnimal($_POST['org_id'], $_POST['animal_id'], $_POST['animal_type'], $_POST['gender'], $_POST['age_years'], $_POST['age_months'], $_POST['age_weeks'], $_POST['age_days'], $_POST['color'], $_POST['animal_description'], $_POST['photo']);
    }   
}

?>