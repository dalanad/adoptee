<?php
class MainController extends Controller
{

    function index()
    {
        View::render("public/home");
    }

    function upload()
    {
        $links = [];
        foreach ($_FILES as $fileName => $value) {
            $uploaded_file = Image::single($fileName);
            array_push($links, $uploaded_file);
        }
        View::json($links);
    }
}
