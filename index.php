<?php

function auto_load($class_name)
{
    $file_locations = array('lib/core', 'lib/services', "controllers", 'models');

    foreach ($file_locations as $folder) {
        $path = "./" . $folder . "/" . $class_name . '.php';

        if (file_exists($path)) {
            require_once __DIR__ . $path;
            break;
        }
    }
}

spl_autoload_register('auto_load');

if (!isset($_SESSION)) {
    session_start();
}

$app = new Application();
$app->process($_SERVER["QUERY_STRING"]);
