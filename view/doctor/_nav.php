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
                <a class="side-link  <?= $key == $active ? 'active' : '' ?> <?= $value["color"] ?? "" ?>" href="/doctor/<?= $key ?>">
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
            <?php
            function pagination($current_page, $page_size, $total_items)
            { ?>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:1rem">
                    <div>
                        <div style="display: flex; align-items:baseline;margin-top:.5rem">
                            <select class="ctrl sm" onchange="params({size:this.value,page:0})">
                                <? foreach ([5, 10, 25, 50, 100] as $i) { ?>
                                    <option value="<?= $i ?>" <?= $i == $page_size ? "selected" : "" ?>><?= $i ?></option>
                                <? } ?>
                            </select>
                            <span style="white-space: nowrap;">&nbsp; Per Page</span>
                        </div>
                    </div>
                    <div>
                        <div class="pagination">
                            <?= $current_page * $page_size + 1 ?> -
                            <?= ((($current_page + 1) * $page_size) > $total_items) ? $total_items : (($current_page + 1) * $page_size) ?>
                            of <?= $total_items ?> &nbsp;
                            <a onclick="params({page: 0 })" class="paginate_button <?= $current_page == 0 ? "disabled" : "" ?>">
                                <i class="far fa-chevron-double-left"></i>
                            </a>
                            <a onclick="params({page: <?= $current_page - 1 ?> })" class="paginate_button <?= $current_page == 0 ? "disabled" : "" ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a onclick="params({page: <?= $current_page + 1 ?> })" class="paginate_button <?= ($current_page) >= intdiv($total_items, $page_size) ? " disabled" : ""  ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a onclick="params({page: <?= intdiv($total_items, $page_size)  ?> })" class="paginate_button <?= ($current_page) == intdiv($total_items, $page_size) ? " disabled" : ""  ?>">
                                <i class="far fa-chevron-double-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <? } ?>