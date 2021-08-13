<?php
class MainController extends Controller
{

    function index()
    {
        View::render("public/home");
    }
}
