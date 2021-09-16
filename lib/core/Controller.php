<?php
require __DIR__ . "/../services/validation_functions.php";
abstract class Controller
{

    protected function redirect(string $location)
    {
        header("Location: $location", true,  302);
        exit();
    }

    protected function isLoggedIn($roles = [])
    {
        if (!isset($_SESSION["user"])) {
            $this->redirect("/auth/sign_in");
        }

        if (!in_array($_SESSION["user_role"], $roles)) {
            $this->redirect("/auth/sign_in");
        }
    }
}
