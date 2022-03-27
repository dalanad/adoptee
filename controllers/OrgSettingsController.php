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
        View::render("org/org_settings/org_user_form", ["user" => []]);
    }

    public function process_create_user()
    {
        OrganizationUser::createOrgUser($_SESSION['org_id'], $_POST["name"], $_POST["email"], $_POST["telephone"], "", $_POST["password"]);
        $this->redirect("users");
    }

    public function edit_user()
    {
        $user = User::findUserById($_GET["user_id"]);
        View::render("org/org_settings/org_user_form", ["user" => $user]);
    }

    public function update_user()
    {
        OrganizationUser::updateUser($_POST["user_id"], $_POST["name"], $_POST["email"], $_POST["telephone"]);
        $this->redirect("users");
    }

    public function change_user_status()
    {
        $user_id = $_GET['user_id'];
        if ($_GET['status'] == 'ACTIVE') {
            OrganizationUser::activateUser($user_id);
        } else {
            OrganizationUser::disableUser($user_id);
        }
        $this->redirect("users");
    }

    public function change_user_role()
    {
        $user_id = $_GET['user_id'];
        $role = $_GET['role'];
        OrganizationUser::changeRole($user_id, $role);
        $this->redirect("users");
    }

    public function sponsorship()
    {
        $data = [
            "active" => "sponsorship",
            "sponsorships" => SponsorshipTier::getSponsorshipsForOrg($_SESSION['org_id'])
        ];
        View::render("org/settings", $data);
    }

    public function sponsorship_tiers()
    {
        $data = [
            "active" => "sponsorship_tiers",
            "tiers" => SponsorshipTier::getAllByOrgId($_SESSION['org_id'])
        ];
        View::render("org/settings", $data);
    }


    function edit_sponsorship_tier()
    {
        $data = [
            "tier" => SponsorshipTier::getOneByOrgIdAndName($_SESSION['org_id'], $_GET["name"])
        ];
        View::render("org/org_settings/sponsorship_tier_form", $data);
    }

    function process_edit_sponsorship_tier()
    {
        SponsorshipTier::updateSponsorshipTier($_SESSION['org_id'], $_POST["old_name"], $_POST["name"], $_POST["amount"], $_POST["description"], $_POST["recurring_days"]);
        $this->redirect("sponsorship_tiers");
    }

    function create_sponsorship_tier()
    {
        View::render("org/org_settings/sponsorship_tier_form");
    }

    function process_create_sponsorship_tier()
    {
        SponsorshipTier::createSponsorshipTier($_SESSION['org_id'], $_POST["name"], $_POST["amount"], $_POST["description"], $_POST["recurring_days"]);
        $this->redirect("sponsorship_tiers");
    }

    function delete_sponsorship_tier()
    {
        SponsorshipTier::deleteSponsorshipTier($_SESSION['org_id'], $_GET["name"]);
        $this->redirect("sponsorship_tiers");
    }
}
