<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoptee</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/site.webmanifest">
    <link href="/assets/vendor/normalize.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendor/fontawesome.css" rel="stylesheet" type="text/css">
    <link href="/assets/vendor/roboto.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css?w=<?= rand(1, 100) ?>" rel="stylesheet" type="text/css" />
    <link href="/assets/css/util.css" rel="stylesheet" type="text/css" />
    <script src="/assets/vendor/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/main.js"></script>
</head>
<?php

function user_btn()
{
    if (isset($_SESSION['user'])) {
        echo
        "<div class='dropdown' style='display:flex;align-items: center;line-height: 1;'>

            <i class='far fa-user-circle' style='font-size:1.2em'> </i>
            <div style='margin-left:.5rem'>" . $_SESSION['user']['name'] .
                (isset($_SESSION['org']) ? ("<br><div> <small style='font-weight: 300;'>" . $_SESSION['org']['name'] . "</small></div>") : "") .
            "</div>
             <div class='dropdown-content'>
                <a class='btn black btn-link' href='/profile/view'><i class='fa fa-user'></i>&nbsp; Profile</a>
                <a class='btn black btn-link'> <i class='fa fa-question'></i>&nbsp; Help</a>
                <a class='btn black btn-link' href='/auth/sign_out'> <i class='fa fa-sign-out'></i>&nbsp; Sign Out</a>
            </div>
        </div>";
    } else {
        echo '<a class="btn green" href="/auth/sign_in">Sign In</a>';
    }
}
?>