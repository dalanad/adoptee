<?php

class ReportRescuesController extends Controller
{

    function view()
    {
        View::render("public/rescues/report_rescue");
    }

    function report(){
        ReportRescue::createReportRescue($_POST["description"],$_POST["location"],$_POST["telephone"],$_POST["animal_type"],$_POST["photo"]);
    }
}
?>