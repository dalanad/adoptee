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
                <a class='btn black btn-link' href='/profile/user_profile'><i class='fa fa-user'></i>&nbsp; Profile</a>"
            . ($_SESSION['user_role'] == "reg_user" ? "<a class='btn black btn-link' href='/merchandise/cart'> <i class='fas fa-shopping-cart'></i></i>&nbsp; Cart</a>" : "") .
            "<a class='btn black btn-link' href='/main/faq'> <i class='fa fa-question'></i>&nbsp; Help</a>
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
        echo
        "<div class='dropdown' style='display:flex;align-items: center;line-height: 1;'>

            <i class='far fa-bell' style='font-size:1.2em'> </i>
             <div class='dropdown-content'>
                <div href=''><a  class='btn black btn-link'>&nbsp; Adoption Request Update</a>
                <div class='m2' style='font-size:small;'>Your request to adopt Tigger has been accepted</div></div>
                <div href=''><a class='btn black btn-link'>&nbsp; Vaccination Reminder</a>
                <div class='m2' style='font-size:small;'>Your pet Tina needs to be vaccinated by 10-10-2021</div></div>
            </div>
        </div>";
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