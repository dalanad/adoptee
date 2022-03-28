<?php

class OrgManagementController extends Controller{

    public function __construct() 
    {
        $this->isLoggedIn(["org_normal","org_admin"]);
    }

    function org_analytics()
    {

        $data = OrgManagement::getDashboardData();
        $data["active"]="org_analytics";
        View::render("org/dashboard",$data);
    }

    function org_adoption_listing()
    {
        $data = [
            "active" => "org_adoption_listing",

            "animals"=>OrgManagement::findAnimalsByOrgId(1)
    ];
        View::render("org/dashboard", $data);
    }

    function add_new_animal()
    {
        View::render("org/org_dashboard/add_new_animal");
    }

    function process_add_new_animal(){
        $vacc_proof =  image::multi("vacc_proof");
        $avatar_photo =  image::single("avatar_photo");
        $adoptee_photo =  image::multi("adoptee_photo");

        
        OrgManagement::createNewAnimal($_SESSION['org_id'], $_POST['name'], $_POST['type'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['description'], $_POST['anti_rabies'], $_POST['dhl'], $_POST['parvo'], $_POST['tricat'], $_POST['anti_rabies_booster'], $_POST['dhl_booster'], $_POST['parvo_booster'], $_POST['tricat_booster'], $_POST['dewormed'], $vacc_proof, $avatar_photo, $adoptee_photo);
        $this->redirect('/OrgManagement/org_adoption_listing');

    }  

    function edit_animal_for_adoption(){
        if(isset($_POST['submit'])){OrgManagement::editAnimalData($_POST['animal_id'], $_POST['status'], $_POST['name'], $_POST['type'], $_POST['gender'], $_POST['dob'], $_POST['color'], $_POST['descripion'], $_POST['photo'], $_POST['photos']);}
    }

    function delete_animal(){
        OrgManagement::delete_animal($_GET['animal_id']);
        $this->redirect('/OrgManagement/org_adoption_listing');
    }

    function adoption_requests()
    {
        $data = [
            "active" => "adoption_requests",
            "adoption_requests"=>OrgManagement::findRequestsByOrgId($_SESSION['org_id']),
            
    ];
        View::render("org/dashboard", $data);
    }

    function accept_adoption_request(){
        OrgManagement::accept_adoption_request($_GET['animal_id'],$_GET['user_id']);
        $this->redirect('/OrgManagement/adoption_requests');
    }

    function reject_adoption_request(){
        OrgManagement::reject_adoption_request($_GET['animal_id']);
        $this->redirect('/OrgManagement/adoption_requests');
    }

    function reported_cases()
    {
        $data = [
            "active" => "reported_cases",
            "reported_cases"=>OrgManagement::findReportedCases()
    ];
        View::render("org/dashboard", $data);
    }

    function rescue_animal()
    {
        $report_id = $_POST['report_id'];
        $type = $_POST['type'];
        OrgManagement::rescue_animal($report_id, $type);
    }

    function mark_as_complete(){
        OrgManagement::mark_as_complete($_GET['report_id']);
        $this->redirect('/OrgManagement/org_rescues');
    }

    function org_rescues()
    {
        $data = [
            "active" => "org_rescues",

            "org_rescues"=>OrgManagement::findRescuedAnimalsByOrgId()
    ];
        View::render("org/dashboard", $data);
    }

    function add_rescue_update()
    {
        View::render("org/org_dashboard/add_rescue_update");
    }

    function process_add_rescue_update()
    {
        $photos=  image::multi("photos");
        OrgManagement::add_rescue_update($_POST['report_id'], $_SESSION['org_id'], $_POST['heading'],$_POST['description'], $photos);
        $this->redirect('/OrgManagement/org_rescues');
    }

    function org_donations()
    {
        $data = [
            "active" => "org_donations",
            "donations" => Organization::getDonations($_SESSION["org_id"])

    ];
        View::render("org/dashboard", $data);
    }

    function org_news_events()
    {
        $data = [
            "active" => "org_news_events",
            "org_news_events"=>OrgManagement::findOrgContentByOrgId()
    ];
        View::render("org/dashboard", $data);
    }

    function delete_news_event(){
        OrgManagement::delete_news_event($_GET['item_id']);
        $this->redirect('/OrgManagement/org_news_events');
    }

    function update_news_event()
    {
       
        $photo =  image::multi("photo");
        
        OrgManagement::update_news_event($_SESSION['item_id'], $_POST['heading'],$_POST['description'], $photo);
        
    }

    function feedback_list()
    {
        $data = [
            "active" => "feedback_list",
            "feedback" => Organization::getAllFeedback($_SESSION['org_id'])
        ];
        View::render("org/dashboard", $data);
    }

    function acknowledge_feedback()
    {
        Organization::acknowledgeFeedback($_SESSION['org_id'],$_GET["user_id"],$_GET["time"]);
        $this->redirect("feedback_list");
    }

    function add_new_event()
    {
        View::render("org/org_dashboard/add_new_event");

        $photos =  image::multi("photos");
        
        OrgManagement::add_new_event($_SESSION['org_id'], $_POST['heading'], $_POST['description'], $photos);
    }

    function merch_orders()
    {
        $data = [
            "active" => "merch_orders"
        ];
        View::render("org/dashboard", $data);
    }

    function animals_report()
    {
        $listed_from = $_GET["listed_from"] ?? "";
        $listed_to = $_GET["listed_to"] ?? "";
        $data = [
            "animals_reports"=>OrgManagement::animals_report($listed_from, $listed_to)
        ];
        View::render("org/org_dashboard/reports/animals_report",$data);
        
    }


    public function reports_list()
    {
        $data = [
            "active" => "reports_list"
        ];
        View::render("org/dashboard", $data);
    }

    function adoptions_updates(){
        $data = ["adoptions_updates"=>OrgManagement::adoptions_updates_report()];
        View::render("org/org_dashboard/reports/adoptions_updates",$data);
       
    }

    function rescue_to_adoption(){
        $data = ["rescue_to_adoption"=>OrgManagement::rescue_to_adoption_report()];
        View::render("org/org_dashboard/reports/rescue_to_adoption",$data);

    }

    function rescues_information(){
        $data = ["rescues_information"=>OrgManagement::rescues_information_report()];
        View::render("org/org_dashboard/reports/rescues_information",$data);

    }

    function donations_summary(){
        $data = ["donations_summary"=>OrgManagement::donations_summary_report()];
        View::render("org/org_dashboard/reports/donations_summary",$data);

    }
}
