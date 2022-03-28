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
        $orgId = $_GET['org_id']?? $_SESSION['org_id'];
        $organization = new Organization;
        $orgData = [
            "tiers" => $organization->getOrgSponsorships($orgId), 
            "sponsorships" => isset($_SESSION['user'])? $organization->getUserSponsorships($orgId,$_SESSION['user']['user_id']) : "", 
            "active"=>"sponsorships", 
            "details" => $organization->getOrgDetails($orgId)
        ];
        
        View::render("public/organizations/organization_profile", $orgData);
        if(isset($_SESSION['org_id'])){unset($_SESSION['org_id']);}
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
        $name = $_POST['displayName']?? NULL;
        $_SESSION['donation_org_id'] = $_POST['org_id'];
        $donation_id = Organization::makeDonation($_SESSION['donation_org_id'], $name, $_POST['comment']);
        $_SESSION['donation_id'] = $donation_id;

        $amount = $_POST['amount']*100;        
        $payment_link = Pay::payment("Donation", $amount, "/Organization/success", "/Organization/cancel_donation_payment", $donation_id);

        $org= new OrganizationController;
        $org->redirect($payment_link);
    }

    public function success()
    {       
        unset($_SESSION['donation_id']);
        require __DIR__ . "/../lib/vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);
        BaseModel::beginTransaction();
        Organization::recordPayment($session);
        BaseModel::commit();

        $this->redirect("/Organization/view_donation_success");
    }

    public function view_donation_success()
    {
        unset($_SESSION['donation_org_id']);
        View::render("public/organizations/donation_success");
    }

    public static function cancel_donation_payment()
    {
        Organization::cancelDonationPayment($_SESSION['donation_id']);
        unset($_SESSION['donation_id']);

        $org = new OrgSettingsController;
        $org->redirect("/Organization/view_donation_page");
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

    public function subscribe()
    {
        $organization = new Organization;
        $sub_id = $organization->subscribe($_POST['tier'],$_POST['org'],$_SESSION['user']['user_id'], $_POST['amount']);
        $_SESSION['org_id'] = $_POST['org'];
        $_SESSION['sub_id'] = $sub_id;

        $amount = $_POST['amount']*100;        
        $payment_link = Pay::subscribe($_POST['tier']." Subscription", $amount, "/Organization/subscription_success", "/Organization/cancel_subscription_payment", $sub_id);

        $this->redirect($payment_link);
    }

    public function unsubscribe()
    {
        $organization = new Organization;
        $organization->unsubscribe($_POST['tier'],$_POST['org'],$_SESSION['user']['user_id']);
        
        $this->redirect("/Organization/get_org_listing");
    }
    
    public function subscription_success()
    {
        unset($_SESSION['sub_id']);

        $_SESSION['donation_id'] = Organization::makeDonation($_SESSION['org_id'],NULL, NULL);
        
        require __DIR__ . "/../lib/vendor/stripe-php-7.97.0/init.php";
        \Stripe\Stripe::setApiKey(Config::get("stripe.secret"));

        $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);
        BaseModel::beginTransaction();
        Organization::recordPayment($session);
        BaseModel::commit();

        unset($_SESSION['donation_id']);

        $this->redirect("/Profile/sponsorships"); 
    }

    public function cancel_subscription_payment()
    {
        Organization::cancelSubscriptionPayment($_SESSION['sub_id']);
        unset($_SESSION['sub_id']);
        $this->redirect("/Organization/get_org_listing");
    }
}
