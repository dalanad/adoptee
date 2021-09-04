<?php require_once __DIR__ . './../_layout/layout.php' ?>
<link rel="stylesheet" href="/assets/css/doctor.css">
<?php
$menu_items = array(
    "home" => array("name" => "Home", "icon" => "home"),
    "tasks" => array("title" => "DOCTOR TASKS"),
    "live_consultation" => array("name" => "Live Consultations", "icon" => "paw"),
    "medical_advise" =>  array("name" =>  "Medical Advise", "icon" => "dog-leashed"),
    "consulted_animals" =>  array("name" =>  "Consulted Animals", "icon" => "exclamation-circle"),
);
?>
<div class="side-nav-container">
    <div class="side-nav">
        <div style="text-align: center;margin-top: 1rem;margin-bottom:.5rem">
            <img src="/assets/images/logo_vector_filled.svg" style="height:35px;margin-right: 1rem;">
        </div>
        <?php foreach ($menu_items as $key => $value) { ?>
            <?php if (isset($value["title"])) {            ?>
                <div style="font-weight: 500;font-size:.75rem;opacity:.4;margin:0 1rem;margin-top:1rem"><?= $value["title"] ?></div>

            <?php } else { ?>
                <a class=" side-link <?= $key == $active ? 'active' : '' ?>" href="/doctor/<?= $key ?>">
                    <span style="width: 1.5rem;display:inline-block"><i class="far fa-<?= $value["icon"] ?>"></i></span>
                    <span class="side-link-text"><?= $value["name"] ?></span>
                </a>
        <?php }
        } ?>
    </div>
    <div class="content" style="width: 100%;">
        <div class="admin-header">
            <div style="font-weight: 700;font-size:1.3rem"><?= $menu_items[$active]["name"] ?> </div>
            <div style="flex: 1 1 0;"></div>
            <?= user_btn() ?>
        </div>
        <div style="padding: 1rem;">