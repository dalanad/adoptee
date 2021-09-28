<?php

class SponsorshipTierController extends Controller
{
    public function __construct()
    {
        $this->isLoggedIn(["org_admin"]);
    }

    function view()
    {
        View::render("org/org_settings/sponsorship_tier");
    }

    function getdata(){
        print_r($_POST);
        SponsorshipTier::createSponsorshipTier($_POST["name"],$_POST["amount"],$_POST["description"]);
        //header('Location:')
    }
}

