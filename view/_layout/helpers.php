<?php

function user_btn()
{
    if (isset($_SESSION['user'])) {
        echo
        "<div class='dropdown' style='display:flex;align-items: center;line-height: 1;'>

            <i class='far fa-user-circle' style='font-size:1.2em'> </i>
            <div style='margin-left:.5rem' class='user-info'>" . $_SESSION['user']['name'] .
            (isset($_SESSION['org']) ? ("<br><div> <small style='font-weight: 300;'>" . $_SESSION['org']['name'] . "</small></div>") : "") .
            "</div>
             <div class='dropdown-content'>
                <a class='btn black btn-link' href='/profile/user_profile'><i class='fa fa-user'></i>&nbsp; Profile</a>
                <a class='btn black btn-link' href='/main/faq'> <i class='fa fa-question'></i>&nbsp; Help</a>
                <a class='btn black btn-link' href='/auth/sign_out'> <i class='fa fa-sign-out'></i>&nbsp; Sign Out</a>
            </div>
        </div>";
    } else {
        echo '<a class="btn green" href="/auth/sign_in">Sign In</a>';
    }
}

function notif_btn()
{
    if (isset($_SESSION['user'])) {
        $notifications = User::getNotifications($_SESSION['user']['user_id']);
        $new_notifi = array_filter($notifications, function ($k) {
            return !$k["seen"];
        });
?>

        <div class='dropdown' style='display:flex;align-items: center;line-height: 1;'>

            <i class='<?php if (sizeof($new_notifi) != 0) { echo "fas fa-bell txt-clr";  } else { echo "far fa-bell"; }?>' id="drop-icon" style='font-size:1.2em'> </i>

            <div class='dropdown-content' style="padding: 0;">
                <?php if (sizeof($notifications) == 0) { ?>
                    <div style="padding: 1rem;text-align:center"> No New Notifications Available</div>
                <?php } ?>
                <?php foreach ($notifications as $notification) { ?>
                    <div class="notification-item">
                        <b style="padding: .5rem  1rem">
                            <i class="<?php if ($notification["seen"]) { ?>far fa-envelope-open <? } else { ?>fas fa-envelope txt-clr <? } ?>"></i>
                            &nbsp; <?= $notification['title'] ?></b>
                        <div style='padding: .5rem 1rem;font-size:.9em;'><?= $notification['message'] ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <script>
            let el = document.querySelector('#drop-icon')
            slide_init(el)

            function slide_init(element) {
                var timer; //wait 2 seconds
                element.onmouseover = function() {
                    timer = setTimeout("slide()", 1000);
                }
                element.onmouseout = function() {
                    clearTimeout(timer);
                } //remove timer
            }

            function slide() {
                fetch("/api/notification_seen").then(e => {
                    el.classList.add("fa-bell",'far')
                    el.classList.remove("fa-bell-plus",'fas', "txt-clr");
                    
                    // todo one by ony delay
                    for (let el of document.querySelectorAll(".fa-envelope")) {
                        el.classList.remove("fas", "fa-envelope", "txt-clr")
                        el.classList.add("far", "fa-envelope-open")
                    }

                })
            }
        </script>
    <?php
    }
}

function cart_btn()
{
    if (isset($_SESSION['user'])) {
        echo
        "<a class='btn black btn-link' href='/merchandise/cart'>
            <i class='far fa-shopping-cart'></i></i>&nbsp; Cart
        </a>";
    }
}

function pagination($current_page, $page_size, $total_items)
{
    ?>
    <div style="display:flex;justify-content:space-between;align-items:center;margin:1rem">
        <div>
            <div style="display: flex; align-items:baseline;margin-top:.5rem">
                <select class="ctrl sm" onchange="params({size:this.value,page:0})">
                    <?php foreach ([5, 10, 25, 50, 100] as $i) { ?>
                        <option value="<?= $i ?>" <?= $i == $page_size ? "selected" : "" ?>><?= $i ?></option>
                    <?php } ?>
                </select>
                <span style="white-space: nowrap;">&nbsp; Per Page</span>
            </div>
        </div>
        <div>
            <div class="pagination">
                <?= $current_page * $page_size + 1 ?> -
                <?= ((($current_page + 1) * $page_size) > $total_items) ? $total_items : (($current_page + 1) * $page_size) ?>
                of <?= $total_items ?> &nbsp;
                <a onclick="params({ page: 0 })" class="paginate_button <?= $current_page == 0 ? "disabled" : "" ?>">
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
<?php
} ?>