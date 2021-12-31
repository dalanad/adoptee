<?php

class OrgSettingsController extends Controller
{
    public function __construct()
    {
        $this->isLoggedIn(["org_admin"]);
    }


    public function general()
    {
        $data = [
            "active" => "general",
            "org" => Organization::findOrgById($_SESSION['org_id'])[0]
        ];
        View::render("org/settings", $data);
    }

    public function update_organization_info()
    {
        Organization::updateOrgInfo($_SESSION['org_id'], $_POST);
        $this->redirect("general");
    }

    public function users()
    {
        $data = [
            "active" => "users",
            "users" => Organization::getOrgUsers($_SESSION['org_id'])
        ];
        View::render("org/settings", $data);
    }

    public function create_user()
    {
        View::render("org/org_settings/create_org_user");
    }

    public function process_create_user()
    {
        OrganizationUser::createOrgUser($_SESSION['org_id'], $_POST["name"], $_POST["email"], "", "", $_POST["password"]);
        $this->redirect("users");
    }

    public function sponsorship()
    {
        $data = ["active" => "sponsorship"];
        View::render("org/settings", $data);
    }

    public function sponsorships()
    {
        $data = ["active" => "sponsorships"];
        View::render("org/settings", $data);
    }

    public function merchandise()
    {
        $data = ["active" => "merchandise"];
        View::render("org/settings", $data);
    }

    public function payments()
    {
        $data = ["active" => "payments"];
        View::render("org/settings", $data);
    }
}
