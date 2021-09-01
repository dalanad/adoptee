<?php

class OrganizationController extends Controller
{
    function view_profile()
    {
        View::render("public/organizations/organization_profile");
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
        $org = $organization->findOrgById($_GET['org_id']);
        $orgData = ["details" => $organization->getOrgContent($_GET['org_id'])];;

        View::render("public/organizations/organization_profile", $orgData);
    }
}

?>