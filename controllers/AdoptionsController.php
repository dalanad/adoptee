<?php

class AdoptionsController extends Controller
{

    function index()
    {
        $org = new Organization();
        $data = [
            "animals" => AdoptionAnimals::searchAnimals(),
            "organizations" => $org->getOrgListing()
        ];
        View::render("public/adoptions/adoption_listing", $data);
    }
}
