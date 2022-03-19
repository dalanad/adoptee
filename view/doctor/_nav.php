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
    "medicine" => array("name" => "Medicine", "icon" => "pills"),
    "payments" => array("name" => "Payments", "icon" => "file-invoice-dollar"),
);
?>
<style>
    .side-nav-toggle {
        display: none;
    }

    .side-nav-container {
        overflow: hidden;
    }

    .content {
        overflow: scroll;
    }

    @media screen and (max-width:600px) {
        .side-nav {
            position: fixed;
            background: white;
            display: none;
            width: 100%;
            z-index: 1000;
            padding: .5rem 1rem;
            box-sizing: border-box;
        }

        .side-nav-toggle {
            display: inline;
        }

        .side-nav.shown {
            display: flex;
        }

        #fold_toggle {
            display: none;
        }

        .side-nav .side-link {
            margin-right: .8rem;
        }
    }
</style>
<div class="side-nav-container">
    <div class="side-nav">
        <div style="text-align: center;margin : 1rem 0; display:flex;justify-content:center">
            <button class="btn btn-link side-nav-toggle black" onclick="document.querySelector('.side-nav').classList.toggle('shown')">
                <i class="far fa-bars"></i>
            </button>
            <img src="/assets/images/logo_vector_filled.svg" class="logo">
            <img src="/assets/images/logo_icon.png" class="logo-mini">
        </div>
        <?php foreach ($menu_items as $key => $value) { ?>

            <?php if (isset($value["title"])) {

                if (isset($value["space_before"])) { ?> <div style="flex:1 1 0"></div><?php } ?>
                <div class="section-heading"><?= $value["title"] ?></div>

            <?php } else { ?>

                <a title="<?= $value["name"] ?>" class="side-link  <?= $key == $active ? 'active' : '' ?> <?= $value["color"] ?? "" ?>" href="/Doctor/<?= $key ?>">
                    <i class="link-icon far fa-<?= $value["icon"] ?>"></i>
                    <span class="side-link-text"><?= $value["name"] ?></span>
                </a>

            <?php } ?>

        <?php } ?>
        <div style="height:.5em"></div>
        <a class="side-link" href="#" id="fold_toggle" onclick="toggle()"></a>
        <div style="height:.5em"></div>
        <script>
            function setIcon() {
                if (document.querySelector('.side-nav').classList.contains('folded')) {
                    fold_toggle.innerHTML = '<i class="link-icon far fa-chevron-right"></i>'
                } else {
                    fold_toggle.innerHTML = '<i style="float:right" class="link-icon far fa-chevron-left"></i>'
                }
            }

            setIcon()

            function toggle() {
                document.querySelector('.side-nav').classList.toggle('folded');
                setIcon()
            }
        </script>
    </div>
    <div class="content" style="width: 100%;">
        <div class="admin-header">
            <div style="font-weight: 500;font-size:1.3rem">
                <button class="btn btn-link side-nav-toggle black" onclick="document.querySelector('.side-nav').classList.toggle('shown')">
                    <i class="fa fa-bars"></i>
                </button>
                <i class="fal fa-<?= $menu_items[$active]["icon"] ?> txt-clr <?= $menu_items[$active]["color"] ?>" style="font-size: 1.2em;"></i>
                &nbsp;
                <?= $menu_items[$active]["name"] ?>
            </div>
            <div style="flex: 1 1 0;"></div>
            <?= user_btn() ?>
        </div>
        <div style="padding: 1rem;">
            <script src="/assets/js/doctor.js"></script>