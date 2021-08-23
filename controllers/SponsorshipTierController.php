<?php

class SponsorshipTierController extends Controller
{

    function view()
    {
        View::render("org/org_settings/sponsorship_tier");
    }

    function getdata(){
        print_r($_POST);
        SponsorshipTier::createSponsorshipTier($_POST["name"],$_POST["amount"],$_POST["description"]);
    }
}

