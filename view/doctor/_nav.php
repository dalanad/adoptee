<?php require_once __DIR__ . './../_layout/layout.php' ?>
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
                <a class="side-link  <?= $key == $active ? 'active' : '' ?> <?= $value["color"] ?>" href="/doctor/<?= $key ?>">
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
            <?php

            function pages_list($total_pages, $current_page, $max_to_show)
            {
                $pages = range(0, $total_pages);
                $total = sizeof($pages);
                // only need ellipsis if we have more pages than we can display
                $needEllipsis = $total  > $max_to_show;
                // show start ellipsis if the current page is further away than max - 4 from the first page
                $hasStartEllipsis = $needEllipsis && $max_to_show - 4 < $current_page;
                // show end ellipsis if the current page is further than total - max + 4 from the last page
                $hasEndEllipsis = $needEllipsis && $current_page < $total  - $max_to_show + 4;

                if (!$needEllipsis) {
                    return $pages;
                }
                if ($hasStartEllipsis && !$hasEndEllipsis) {
                    $pageCount = $max_to_show - 2;
                    return array_merge([$pages[0], -1], array_slice($pages, $total - $pageCount));
                }
                if (!$hasStartEllipsis && $hasEndEllipsis) {
                    $pageCount =   $max_to_show - 2;
                    return array_merge(array_slice($pages, 0,  $pageCount), [-1, $pages[$total - 1]]);
                }
                // we have both start and end ellipsis
                $pageCount = $max_to_show - 4;
                return array_merge(
                    [$pages[0], -1],
                    array_slice($pages, $current_page - floor($pageCount / 2), $current_page  + $pageCount - 1),
                    [-1,  $pages[$total - 1]]
                );
            }

            function pagination($current_page, $page_size, $total_items)
            { ?>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:1rem">
                    <div>
                        <div>
                            <label class="">Showing
                                <?= $current_page * $page_size + 1 ?> to
                                <?= ((($current_page + 1) * $page_size) > $total_items) ? $total_items : (($current_page + 1) * $page_size) ?>
                                of <?= $total_items ?>
                            </label>
                        </div>
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
                            <a onclick="params({page: <?= $current_page - 1 ?> })" class="paginate_button <?= $current_page == 0 ? "disabled" : "" ?>">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                            <? foreach (pages_list(($total_items / $page_size), $current_page, 6) as $i) { ?>

                                <? if ($i !== -1) { ?>
                                    <a onclick="params({page: <?= $i ?> })" class="paginate_button <?= $current_page == $i ? " active" : "" ?>"><?= $i + 1 ?></a>
                                <? } else { ?>

                                    <div class="paginate_button disabled  px-0">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </div>
                            <? }
                            } ?>

                            <a onclick="params({page: <?= $current_page + 1 ?> })" class="paginate_button <?= ($current_page) >= intdiv($total_items, $page_size) ? " disabled" : ""  ?>">
                                <i class="fa fa-chevron-right"></i>
                            </a>

                        </div>
                    </div>
                </div>
            <? } ?>