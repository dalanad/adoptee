<?php

class ReportRescuesController extends Controller
{

    function view()
    {
        View::render("public/rescues/report_rescue");
    }

    function report()
    {


        $description = $_POST["description"];
        $location = $_POST["location"];
        $telephone = $_POST["telephone"];
        $type = $_POST["type"];
        $photo =  new Image("photo");

        ReportRescue::createReportRescue($description,$location,$telephone,$type, $photo);
    }
}
