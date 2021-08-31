<?php

class AdoptionsController extends Controller
{

    function index()
    {
        $data = [
            "animals" => AdoptionAnimals::searchAnimals()
        ];
        View::render("public/adoptions/adoption_listing", $data);
    }
}
