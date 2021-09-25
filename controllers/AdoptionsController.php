<?php

class AdoptionsController extends Controller
{

    function index()
    {
        $org = new Organization();
        $data = [
            "animals" => Adoptions::searchAnimals(),
            "organizations" => $org->getOrgListing()
        ];
        View::render("public/adoptions/adoption_listing", $data);
    }

    function adopteeUpdate()
    {
        Adoptions::adopteeUpdate($_SESSION['user']['user_id'], $_POST['animalId'], $_POST['type'], $_POST['desc'], $_POST['photo']);
        $this->redirect("/Profile/adoptions");
    }
}
