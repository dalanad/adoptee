<?php

class AdoptionRequestController extends Controller{

    function view()
    {
        View::render("public/adoptions/adoption_request");
    }

    function submit(){
        AdoptionRequest::createAdoptionRequest('132', '132', '32', $_POST['has_pets'], $_POST['petsafety'], $_POST['children'], $_POST['childsafety']);
    }   
}

?>