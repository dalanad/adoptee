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
    <meta name="description" content="Pet Adoption & Animal Care Platform">
    <meta name="theme-color" content="#08d5a2">
    <link href="/assets/vendor/normalize.css" rel="stylesheet" type="text/css" />
    <link href="/assets/vendor/fontawesome.css" rel="stylesheet" type="text/css">
    <link href="/assets/vendor/roboto.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css?w=<?= rand(1, 100) ?>" rel="stylesheet" type="text/css" />
    <link href="/assets/css/util.css" rel="stylesheet" type="text/css" />
    <script src="/assets/vendor/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
        // Check that service workers are supported
        if ('serviceWorker' in navigator) {
            // Use the window load event to keep the page load performant
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/assets/js/service-worker.js');
            });
        }
    </script>
</head>
<?php require __DIR__ . '/helpers.php' ?>