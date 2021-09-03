<?php
class Application
{
    private $params = ["url" => ""];

    public function __construct()
    {
        ini_set("file_uploads", "On");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        set_exception_handler([$this, 'handleException']);
        set_error_handler([$this, 'handleError']);
    }

    public function process($qs = "")
    {
        $params = [];
        parse_str($qs, $params);

        $this->params = array_merge($this->params, $params);

        $url = rtrim($this->params["url"], "/");
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $path = explode("/", $url);
        $this->match($path);
    }


    private function match($path)
    {
        $controller = (isset($path[0]) && $path[0] != "" ? $path[0] :   "Main") . "Controller";

        $action = $path[1] ?? "index";

        if (class_exists($controller)) {
            $controller_object = new $controller();

            if (is_callable([$controller_object, $action])) {
                $controller_object->$action();
            } else {
                throw new Exception("This Page Does Not Exist", 404);
            }
        } else {
            throw new Exception("This Page Does Not Exist", 404);
        }
    }


    public function handleException(Exception $exception)
    {
        $code = $exception->getCode();

        if ($code != 404) {
            $code = 500;
        }

        http_response_code($code);

        View::render("_layout/error", ["exception" => $exception]);
    }

    public static function handleError($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            echo  $message;
           // throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }
}
