<?php

function is_email($value, &$errors = null)
{
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        if ($errors)
            array_push($errors, "Invalid email");
        else
            throw new Exception("Invalid email");
    }

    return $value;
}
