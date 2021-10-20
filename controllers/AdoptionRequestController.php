<?php

class AdoptionRequestController extends Controller{

    function view()
    {
        $request = new AdoptionRequest;
        $org = new Organization;
        if(isset($_SESSION['user'])){
            $submission = $request -> getUserRequest($_GET['animal_id'], $_SESSION['user']['user_id']);
        };
        $petData = [
            "submission" => $submission?? "",
            "petdata" => $request->getPetData($_GET['animal_id']),
            "org" => $org->getOrgDetails($_GET['org_id']),
            "req" => $request->checkRequestsForPet($_GET['animal_id'])
        ];
        View::render("public/adoptions/adoption_request", $petData);
    }

    function submit()
    {
        $submission = AdoptionRequest::createAdoptionRequest($_GET['animal_id'], $_GET['org_id'], $_SESSION['user']['user_id'], $_POST['has_pets'], $_POST['petsafety']?? "", $_POST['children'], $_POST['childsafety']?? "");
        $request = new AdoptionRequest;
        $org = new Organization;        
        $petData = ["petdata" => $request->getPetData($_GET['animal_id']), "org" => $org->getOrgDetails($_GET['org_id']), "submitted" => true, "submission" => $submission];
        View::render("public/adoptions/adoption_request", $petData);
        // Adoptions::hidePet($_GET['animal_id']); //backend incomplete
    }   
}
