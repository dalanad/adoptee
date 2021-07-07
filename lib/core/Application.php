<?php
class Application
{
    function processRequest()
    {
        $url = isset($_GET["url"]) ? $_GET["url"] : "";
        $path = explode("/", $url);

        if ($path[0] == "employee") {
            $controllerName = $path[0] . "Controller";
            $action = $path[1];
            $c = new $controllerName();
            $c->$action();
        } else {
            $c = new Controller();
            $c->HomePage();
        }
    }
}
