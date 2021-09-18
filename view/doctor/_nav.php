<?php require_once __DIR__ . '/../_layout/layout.php' ?>
<link rel="stylesheet" href="/assets/css/doctor.css">
<?php
$menu_items = array(
    "home" => array("name" => "Home", "icon" => "home", "color" => "blue"),
    "tasks" => array("title" => "YOUR TASKS"), // sub heading -> Tasks
    "live_consultation" => array("name" => "Live Consultations", "icon" => "webcam", "color" => "pink"),
    "medical_advise" =>  array("name" =>  "Medical Advise", "icon" => "user-md-chat", "color" => "orange"),
    "consulted_animals" =>  array("name" =>  "Consulted Animals", "icon" => "cat", "color" => "green"),
    "settings" => array("title" => "SETTINGS", "space_before" => true), //sub heading -> Settings
    "schedule" => array("name" => "Appointment Schedule", "icon" => "calendar-alt"),
    "payments" => array("name" => "Payments", "icon" => "file-invoice-dollar"),

);

?>
<div class="side-nav-container">
    <div class="side-nav">
        <div style="text-align: center;margin : 2rem 0; ">
            <img src="/assets/images/logo_vector_filled.svg" style="height:45px;margin-right: 1rem;">
        </div>
        <?php foreach ($menu_items as $key => $value) { ?>
            <?php if (isset($value["title"])) {

                if (isset($value["space_before"])) { ?> <div style="flex:1 1 0"></div><?php } ?>

                <div class="section-heading"><?= $value["title"] ?></div>

            <?php } else { ?>
                <a class="side-link  <?= $key == $active ? 'active' : '' ?> <?= $value["color"] ?? "" ?>" href="/Doctor/<?= $key ?>">
                    <i class="link-icon far fa-<?= $value["icon"] ?>"></i>
                    <span class="side-link-text"><?= $value["name"] ?></span>
                </a>
        <?php }
        } ?>
        <div style="height:2em"></div>
    </div>
    <div class="content" style="width: 100%;">
        <div class="admin-header">
            <div style="font-weight: 500;font-size:1.3rem">
                <i class="fal fa-<?= $menu_items[$active]["icon"] ?> txt-clr <?= $menu_items[$active]["color"] ?>" style="font-size: 1.2em;"></i>
                &nbsp;
                <?= $menu_items[$active]["name"] ?>
            </div>
            <div style="flex: 1 1 0;"></div>
            <?= user_btn() ?>
        </div>
        <div style="padding: 1rem;">
            <script src="/assets/js/doctor.js"></script>
           