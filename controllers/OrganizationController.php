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

    static function get_org_adoption()
    {
        $organization = new Organization;
        $orgData = ["animals" => $organization->getOrgAdoptions($_GET['org_id']), "active"=>"adoption", "details" => $organization->getOrgDetails($_GET['org_id'])];
        
        View::render("public/organizations/organization_profile", $orgData);
    }

    static function get_org_merchandise()
    {
        $organization = new Organization;
        $orgData = ["merchandise" => $organization->getOrgMerchandise($_GET['org_id']), "active"=>"merchandise", "details" => $organization->getOrgDetails($_GET['org_id'])];
        
        View::render("public/organizations/organization_profile", $orgData);
    }

    static function get_org_sponsorships()
    {
        $organization = new Organization;
        $orgData = ["sponsorship" => $organization->getOrgSponsorships($_GET['org_id']), "active"=>"sponsorships", "details" => $organization->getOrgDetails($_GET['org_id'])];
        
        View::render("public/organizations/organization_profile", $orgData);
    }

    static function get_org_about()
    {
        $organization = new Organization;
        $orgData = ["active"=>"about", "details" => $organization->getOrgDetails($_GET['org_id'])];
        
        View::render("public/organizations/organization_profile", $orgData);
    }

    static function view_review_page()
    {
        $organization = new Organization;
        $data=["details" => $organization->getOrgDetails($_GET['org_id'])];
        View::render("public/organizations/review_organization", $data);
    }

    static function view_donation_page()
    {
        if(isset($_GET['org_id'])){
            $org_id = $_GET['org_id'];
        }
        else{
            $org_id = $_SESSION['donation_org_id'];
            unset($_SESSION['donation_org_id']);
        }
        $organization = new Organization;
        $data=["details" => $organization->getOrgDetails($org_id)];
        View::render("public/organizations/donations", $data);
    }

    static function make_donation()
    {
        $_SESSION['donation_org_id'] = $_POST['org_id'];
        $amount = $_POST['amount']*100;        
        $payment_link = Pay::payment("Donation", $amount, "/Organization/success");

        $org= new OrganizationController;
        $org->redirect($payment_link);

        // $name = $_POST['displayName']?? "";
        // $subscriptionId = $_POST['subscribe']?? "";
        // $receipt = (isset($_POST['sendReceipt']))? 'true':'false';
        // $email = $_POST['sendReceipt']?? "";
        // Organization::makeDonation($name, $email, $receipt, $subscriptionId);     // 
    }

    public function success()
    {
        $this->redirect("/Organization/view_donation_success");
        die();

        require __DIR__ . "/../lib/vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);

        echo "<pre>";
        echo json_encode($session, JSON_PRETTY_PRINT);
    }

    public function view_donation_success()
    {
        View::render("public/organizations/donation_success");
    }
}

?>