<?php
require __DIR__ . "/../services/validation_functions.php";
abstract class Controller
{

    protected function redirect(string $location)
    {
        header("Location: $location", true,  302);
        exit();
    }
}
