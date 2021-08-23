<?php
abstract class Controller
{
    protected function redirect(string $location)
    {
        header("Location: $location", true,  302);
        exit();
    }
}
