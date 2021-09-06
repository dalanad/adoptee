<?php

class ReportRescuesController extends Controller
{

    function view()
    {
        View::render("public/rescues/report_rescue");
    }

    function report(){
     
        $org_id = $_POST["org_id"];
        $description= $_POST["description"];
        $location = $_POST["location"];
        $telephone = $_POST["telephone"];
        $type = $_POST["type"];
        $photo =  new Image("photo");
    }
}
?>