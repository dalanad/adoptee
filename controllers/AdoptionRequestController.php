<?php

class AdoptionRequestController extends Controller{

    function view()
    {
        $request = new AdoptionRequest;
        $petData = ["petdata" => $request->getPetData($_GET['animal_id'])];
        View::render("public/adoptions/adoption_request", $petData);
    }

    function submit()
    {
        AdoptionRequest::createAdoptionRequest($_GET['animal_id'], $_GET['org_id'], $_SESSION['user']['user_id'], $_POST['has_pets'], $_POST['petsafety'], $_POST['children'], $_POST['childsafety']);
    }   
}

?>