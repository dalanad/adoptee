<?php

require_once  __DIR__ . '/../../_layout/header.php';

// common profile menu
$profile_menu = array(
    "update_profile" => array("name" => "Profile", "icon" => "user-cog"),
    "change_password" =>  array("name" =>  "Password", "icon" => "unlock-alt"),
    "notifications" =>  array("name" =>  "Notifications", "icon" => "bell"),
);

// Add links to the registerd user functions only if the current user is a normal user
if ($_SESSION['user_role'] == "reg_user") {
    $reg_user = array(
        "consultations" =>  array("name" =>  "Consultations", "icon" => "user-md-chat"),
        "adoptions" =>  array("name" =>  "Adoptions", "icon" => "dog"),
        "rescues" =>  array("name" =>  "Rescues", "icon" => "briefcase-medical"),
        "my_pets" => array("name" => "My Pets", "icon" => "paw"),
        "sponsorships" =>  array("name" =>  "Sponsorships", "icon" => "donate"),
        "payments" =>  array("name" =>  "Payments", "icon" => "money-check"),
    );
    $profile_menu = array_merge($profile_menu, $reg_user);
}
?>

<style>
    .settings-container {
        display: flex;
        margin: 1rem;

    }

    .side-nav {
        flex: 1 1 0;
        min-width: 12rem;
        max-width: 12rem;
        display: flex;
        flex-direction: column;
    }

    .side-nav-link {
        display: block;
        padding: 0.6em 1em;
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

<div style="max-width: 900px; margin: 0 auto;">
    <h2 style="margin-left:1rem;"><?= $_SESSION['user']['name']; ?></h2>
    <div class="settings-container ">
        <div class="side-nav">
            <?php foreach ($profile_menu as $key => $value) { ?>
                <a class="side-nav-link <?= $key == $active ? 'active' : '' ?>" href="/profile/<?= $key ?>">
                    <i class="far fa-<?= $value["icon"] ?>"></i> &nbsp; <?= $value["name"] ?>
                </a>
            <?php  } ?>
        </div>

        <div class="flex-auto mx2 " style="border: 1px solid var(--gray-4);border-radius: .5rem;padding:1rem">
            <?php include __DIR__ . "/" . $active . ".php" ?>
        </div>
    </div>
</div>