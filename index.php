<?php

function auto_load($class_name)
{
    $file_locations = array('lib/core', "controllers", 'model');

    foreach ($file_locations as $folder) {
        $path = "./" . $folder . "/" . $class_name . '.php';

        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
}

spl_autoload_register('auto_load');

$app = new Application();
$app->processRequest();


