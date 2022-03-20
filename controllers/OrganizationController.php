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
        $orgData = [
            "tiers" => $organization->getOrgSponsorships($_GET['org_id']), 
            "sponsorships" => $organization->getUserSponsorships($_GET['org_id'],$_SESSION['user']['user_id']), 
            "active"=>"sponsorships", 
            "details" => $organization->getOrgDetails($_GET['org_id'])
        ];
        
        View::render("public/organizations/organization_profile", $orgData);
    }

    static function get_org_about()
    {
        $organization = new Organization;
        $orgData = ["active"=>"about", "details" => $organization->getOrgDetails($_GET['org_id'])];
        
        View::render("public/organizations/organization_profile", $orgData);
    }

    static function get_org_reviews()
    {
        $organization = new Organization;
        $orgData = ["active"=>"reviews", "reviews" => $organization->getOrgReviews($_GET['org_id']), "details" => $organization->getOrgDetails($_GET['org_id'])];
        
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
        $payment_link = Pay::payment("Donation", $amount, "/Organization/success", "/Organization/view_donation_page");

        $org= new OrganizationController;
        $org->redirect($payment_link);

        // $name = $_POST['displayName']?? "";
        // $subscriptionId = $_POST['subscribe']?? "";
        // $receipt = (isset($_POST['sendReceipt']))? 'true':'false';
        // $email = $_POST['sendReceipt']?? "";
        // Organization::makeDonation($name, $email, $receipt, $subscriptionId);     // 
    }

    static function makeReview()
    {
        $living_conditions = isset($_POST['Pet_Living_Conditions'])? (int)substr($_POST['Pet_Living_Conditions'],-1):0;
        $healthcare = isset($_POST['Pet_Healthcare'])? (int)substr($_POST['Pet_Healthcare'],-1):0;
        $rescue_response = isset($_POST['Rescue_Report_Response'])? (int)substr($_POST['Rescue_Report_Response'],-1):0;
        $adoptions = isset($_POST['Adoption_Request_Handling'])? (int)substr($_POST['Adoption_Request_Handling'],-1):0;
        $resource_allocation = isset($_POST['Resource_Allocation'])? (int)substr($_POST['Resource_Allocation'],-1):0;
        $name = $_POST['name']?? 0;
        $email = $_POST['email']?? 0;

        Organization::writeReview($living_conditions,$healthcare,$rescue_response,$adoptions,$resource_allocation, $_POST['comment'], $name, $email, $_POST['org_id'],$_SESSION['user']['user_id']);
        $organization = new Organization;
        $data=["details" => $organization->getOrgDetails($_POST['org_id'])];
        View::render("public/organizations/review_organization", $data);
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

    public function subscribe()
    {
        $organization = new Organization;
        $organization->subscribe($_POST['tier'],$_POST['org'],$_SESSION['user']['user_id']);
        $orgData = ["sponsorship" => $organization->getOrgSponsorships($_POST['org'],$_SESSION['user']['user_id']), "active"=>"sponsorships", "details" => $organization->getOrgDetails($_POST['org'])];
        print_r($orgData);
        // View::render("public/organizations/organization_profile", $orgData);
    }

    public function unsubscribe()
    {
        $organization = new Organization;
        $organization->unsubscribe($_POST['tier'],$_POST['org'],$_SESSION['user']['user_id']);
        $orgData = ["sponsorship" => $organization->getOrgSponsorships($_POST['org'],$_SESSION['user']['user_id']), "active"=>"sponsorships", "details" => $organization->getOrgDetails($_POST['org'])];
        print_r($orgData);
    }    
}

?>