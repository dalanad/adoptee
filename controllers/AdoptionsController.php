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
        $selections = Adoptions::getSelections();

        if (!isset($_GET['type'])) {
            $_GET['type'] = 'select';
        }
        if (!isset($_GET['breed'])) {
            $_GET['breed'] = 'select';
        }
        //check if breed belongs to selected type
        $match = false;
        foreach ($selections as $key => $value) {
            if ($value['type'] == $_GET['type']) {
                if ($value['breed'] == $_GET['breed']) {
                    $match = true;
                }
            }
        }

        //find first breed under selected type
        $index = 0;
        foreach ($selections as $key => $value) {
            if ($value['type'] == $_GET['type']) {
                $index = $key;
                break;
            }
        }

        //set the breed for the filter
        $breed = $_GET["breed"] ?? "select";
        if (!$match) {
            $breed = $selections[$index]['breed'];
        }

        $filter = [
            "type" => $_GET["type"] ?? "select",
            "breed" => $breed,
        ];

        $data = [
            "info" => Adoptions::getBreedInfo($filter),
            "selections" => $selections,
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
