<?php

function is_email($value, &$errors)
{
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email");
    }

    return $value;
}

