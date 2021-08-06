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
        } else if ($path[0] == "") {
            $s = new Controller();
            $s->HomePage();
        } else {
            header("HTTP/1.0 404 Not Found");
            print_r($path);
            echo "404 Page Not found";
            die();
        }
    }
}
