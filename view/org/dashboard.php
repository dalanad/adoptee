<?php


require_once  __DIR__ . '/../_layout/layout.php';

$management_menu = array(
    "org_analytics" =>  array("name" =>  "Analytics Dashboard", "icon" => "chart-line"),
    "org_adoption_listing" => array("name" => "Adoption Listing", "icon" => "paw"),
    "adoption_requests" =>  array("name" =>  "Adoption Requests", "icon" => "dog"),
    "reported_cases" =>  array("name" =>  "Reported Cases", "icon" => "exclamation-circle"),
    "org_rescues" =>  array("name" =>  "Rescues", "icon" => "ambulance"),
    "org_donations" =>  array("name" =>  "Donations", "icon" => "hand-holding-usd"),
    "org_news_events" =>  array("name" =>  "News & Events", "icon" => "calendar-alt"),
    "reports_list" =>  array("name" =>  "Organization Reports", "icon" => "file-chart-line")
);

$administration_menu = array(
    "feedback_list" => array("name" => "User Feedback", "icon" => "smile"),
    "organization_settings" =>  array("name" =>  "Settings", "icon" => "cog"),
    "help" =>  array("name" =>  "Help", "icon" => "question-circle"),
);

$active_item = isset($management_menu[$active]) ? $management_menu[$active] : (isset($administration_menu[$active]) ? $administration_menu[$active] :  array("name" => "Dashboard", "icon" => "chart-line"))

?>

<style>
    .admin-header {
        padding: 1rem 1rem;
        display: flex;
        box-sizing: border-box;
        align-items: center;
    }

    .settings-container {
        display: flex;
    }

    .side-nav {
        flex: 1 1 0;
        margin-left: 1rem;
        margin-right: .5rem;
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

    .side-nav-link:hover {
        transition: background .3s ease-in-out, border-color .3s ease-in-out, color .2s ease-in-out;
        background: #ebf4ff;
        color: var(--primary);

    }

    .side-nav-link.active {
        color: var(--primary);
        background: #ebf4ff;

    }

    @media (max-width:700px) {
        .settings-container {
            flex-direction: column;
        }

        .side-nav-link {
            margin: 0 0.3em;
        }

        .side-nav-link:first-child {
            margin-left: 1rem;
        }

        .side-nav-link:last-child {
            margin-right: 1rem;
        }

        .side-nav::-webkit-scrollbar {
            height: 3px;
        }

        .side-nav {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .side-nav {
            overflow: auto;
            flex-direction: row;
            margin-left: 0rem;
            flex: unset;
            margin-bottom: 1rem;
            padding-bottom: .5rem;
            max-width: unset
        }
    }
</style>


<div>
    <div class="settings-container ">
        <div class="side-nav" style="font-size: 0.9em;">
            <div style="text-align: center; margin: 2rem 0;">
                <img src="/assets/images/logo_vector_filled.svg" style="height:45px; margin-right: 1rem;">
            </div>
            <div>
                <div class="mx1">
                    <h4 class="mr1" style="color: #aaa6a1; font-size: 1em; font-weight: 400; letter-spacing: 1px">
                        MANAGEMENT
                    </h4>
                </div>

                <?php foreach ($management_menu as $key => $value) { ?>
                    <a class="side-nav-link <?= $key == $active ? 'active' : '' ?>" href="<?= $key ?>">
                        <i class="far fa-<?= $value["icon"] ?>"></i> &nbsp; <?= $value["name"] ?>
                    </a>
                <?php  } ?>
            </div>
            <?php if($_SESSION["user_role"] == "org_admin") { ?>
            <div style="position:fixed; bottom: 20px; min-width: 12rem; max-width: 12rem;">
                <div class="mx1">
                    <h4 class="mr1" style="color: #aaa6a1; font-size: 1em; font-weight: 400; letter-spacing: 1px">
                        ADMINISTRATION
                    </h4>
                </div>
                <a class="side-nav-link <?= $active == "feedback_list"  ? 'active' : '' ?>" href="feedback_list">
                    <i class="far fa-smile"></i> &nbsp; Feedback
                </a>
                <a class="side-nav-link <?= $active == "setting"  ? 'active' : '' ?>" href="/OrgSettings/general">
                    <i class="far fa-cog"></i> &nbsp; Settings
                </a>
                <a class="side-nav-link <?= $active == "help" ? 'active' : '' ?>" href="/main/faq">
                    <i class="far fa-question-circle"></i> &nbsp; Help
                </a>
            </div>
            <?php } ?>
        </div>

        <div class="content" style="width: 100%; margin-left: .5rem">
            <div class="admin-header">
                <div style="font-weight: 500;font-size:1.3rem;display:flex">
                    <i class="fal fa-<?= $active_item["icon"] ?> txt-clr <?= $active_item["icon"] ?>" style="font-size: 1.2em;"></i>
                    &nbsp;
                    <?= $active_item["name"] ?>
                </div>
                <div style="flex: 1 1 0;"></div>
                <?= user_btn() ?>
            </div>
            <div>
                <div class="flex-auto" style=" height: 600px; width: 97%;">
                    <?php include __DIR__ . "/org_dashboard/" . $active . ".php" ?>
                </div>
            </div>

        </div>

    </div>
</div>