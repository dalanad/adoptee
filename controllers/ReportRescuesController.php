<?php

class ReportRescuesController extends Controller
{
    public function view()
    {
        View::render("public/rescues/report_rescue");
    }

    public function report()
    {
        $description = $_POST["description"];
        $location = $_POST["location"];
        $telephone = $_POST["telephone"];
        $lat = $_POST["lat"];
        $lang = $_POST["lang"];
        $type = $_POST["type"];
        $photos = Image::multi("photos");

        $report_id = ReportRescue::createReportRescue($description, $location, $telephone, $type, $photos, $lat, $lang);

        $this->redirect("/ReportRescues/success?id=$report_id");
    }

    public function success()
    {
        $report = ReportRescue::getRescueReportById($_GET["id"]);
        $data = ["report" => $report];
        View::render("public/rescues/success", $data);
    }
}
