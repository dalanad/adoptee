<?php
class View
{
    static function render($view_name, $args = [])
    {
        extract($args, EXTR_SKIP);
        require __DIR__ . "/../../view/$view_name.php";
    }
}
