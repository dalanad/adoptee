<?php

class OrganizationController extends Controller
{
    function view_profile()
    {
        $organization = new Organization;
        $orgData =["details" => $organization->getOrgDetails($_GET['org_id'])]; 

        View::render("public/organizations/organization_profile", $orgData);
    }

    static function get_org_listing()
    {
        $organization = new Organization;
        $data = ["orgs" => $organization->getOrgListing()];

        View::render("public/organizations/organization_listing", $data);
    }

    static function get_org_timeline()
    {
        $organization = new Organization;
        $orgData = ["content" => $organization->getOrgContent($_GET['org_id']), "active"=>"timeline", "details" => $organization->getOrgDetails($_GET['org_id'])];
        
        View::render("public/organizations/organization_profile", $orgData);
    }

    static function get_org_about()
    {
        $organization = new Organization;
        $orgData = ["active"=>"about", "details" => $organization->getOrgDetails($_GET['org_id'])];
        
        View::render("public/organizations/organization_profile", $orgData);
    }
}

?>