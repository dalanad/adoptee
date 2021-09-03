<?php

class AdoptionRequestController extends Controller{

    function view()
    {
        $request = new AdoptionRequest;
        $petData = ["data" => $request->getPetData($_GET['animal_id'])];
        View::render("public/adoptions/adoption_request", $petData);
    }

    function submit()
    {
        // $animal_id=;
        // $org_id=;
        // $user_id=;
        AdoptionRequest::createAdoptionRequest('132', '132', '32', $_POST['has_pets'], $_POST['petsafety'], $_POST['children'], $_POST['childsafety']);
    }   
}

?>