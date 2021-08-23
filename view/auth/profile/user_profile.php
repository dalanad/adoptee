<?php

require_once  __DIR__ . './../../_layout/layout.php';

$profile_menu = array(
    "update_profile" => array("name" => "Profile", "icon" => "user-cog"),
    "change_password" =>  array("name" =>  "Password", "icon" => "unlock-alt"),
    "notifications" =>  array("name" =>  "Notifications", "icon" => "bell"),
    "adoptions" =>  array("name" =>  "Adoptions", "icon" => "dog"),
    "rescues" =>  array("name" =>  "Rescues", "icon" => "briefcase-medical"),
    "sponsorships" =>  array("name" =>  "Sponsorships", "icon" => "donate"),
    "payments" =>  array("name" =>  "Payments", "icon" => "money-check"),
);

$active = isset($_GET["menu"]) && isset($profile_menu[$_GET["menu"]])  ? $_GET["menu"] : "update_profile";
$active = isset($_GET["menu"]) && isset($profile_menu[$_GET["menu"]])  ? $_GET["menu"] : $active;

?>

<style>
    .side-nav {
        flex: 1 1 0;
        margin-left: 1rem;
        min-width: 12rem;
        max-width: 12rem;
        display: flex;
        flex-direction: column;
    }

    .side-nav-link {
        display: block;
        padding: 0.6em 0.5em;
        margin-bottom: 0.1em;
        background: none;
        text-decoration: none;
        color: #313636;
        line-height: 0.9;
        font-weight: 400;
        border-radius: 8px;
        white-space: nowrap;
        scroll-margin: 0.6em;
    }

    .side-nav-link.active {
        color: var(--primary);
        background: #ebf4ff;
    }
</style>

<div>
    <div class="settings-container ">
        <div class="side-nav" style="font-size: 0.9em">
            <?php foreach ($profile_menu as $key => $value) { ?>
                <a class="side-nav-link <?= $key == $active ? 'active' : '' ?>" href="?menu=<?= $key ?>">
                    <i class="fa fa-<?= $value["icon"] ?>"></i> &nbsp; <?= $value["name"] ?>
                </a>
            <?php  } ?>
        </div>

        <div class="flex-auto mx2 " style="border: 1px solid var(--gray-4);border-radius: .5rem;">
            <?php include "./" . $active . ".php" ?>
        </div>
    </div>
</div>