<?php

class AdoptionsController extends Controller
{

    function index()
    {
        $filter = ["gender" => $_GET["gender"] ?? "ANY",
                    "age" => $_GET["age"] ?? "",
                    "animal_type" => $_GET["animal_type"] ?? [],
                    "color" => $_GET["color"] ?? [],
                    "organization" => $_GET["organization"] ?? [],
                    "sort" => $_GET['sort'] ?? "date-listed",
                    "order" => $_GET['order'] ?? "desc"
        ];

        $org = new Organization();
        $data = [
            "organizations" => $org->getOrgListing(),
            "animals" => Adoptions::searchAnimals($filter),
            "filter" => $filter
        ];
        View::render("public/adoptions/adoption_listing", $data);
    }

    function adopteeUpdate()
    {
        Adoptions::adopteeUpdate($_SESSION['user']['user_id'], $_POST['animalId'], $_POST['type'], $_POST['desc'], $_POST['photo']);
        $this->redirect("/Profile/adoptions");
    }
}
