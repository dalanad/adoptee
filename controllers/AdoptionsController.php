<?php

class AdoptionsController extends Controller
{

    function index()
    {
        $filter = [
            "gender" => $_GET["gender"] ?? "ANY",
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

    function viewBreeds()
    {
        $filter = [
            "type" => $_GET["type"] ?? "select",
            "breed" => $_GET["breed"] ?? "select",
        ];

        $data = [
            "info" => Adoptions::getBreedInfo($filter),
            "selections" => Adoptions::getSelections(),
            "filter" => $filter
        ];

        View::render("public/adoptions/breeds", $data);
    }

    static function addBreedInfo()
    {
        View::render("system_admin/add_breed_info");
    }

    static function processBreedInfo()
    {
        $photo = Image::single('photo');
        Adoptions::processBreedInfo($_POST['type'], $_POST['breed'], $_POST['height'], $_POST['weight'], $_POST['life-expectancy'], $_POST['color'], $photo, $_POST['child_friendly'], $_POST['pet_friendly'], $_POST['health'], $_POST['problems']);
        self::addBreedInfo();
    }

    function addAdopteeUpdate()
    {
        $photo = image::single("photo");
        Adoptions::adopteeUpdate($_SESSION['user']['user_id'], $_POST['animalId'], $_POST['type'], $_POST['desc'], $photo);
        $this->redirect("/Profile/adoptions");
    }
}
