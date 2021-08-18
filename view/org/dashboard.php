<?php


require_once  __DIR__ . './../_layout/layout.php';

$data["header"]["nav"] = false;
$data["user"] = "Dalana";

require __DIR__ . "./../_layout/org_header.php";

$management_menu = array(
    "org_adoption_listing" => array("name" => "Adoption Listing", "icon" => "paw"),
    "adoption_requests" =>  array("name" =>  "Adoption Requests", "icon" => "dog"),
    "reported_cases" =>  array("name" =>  "Reported Cases", "icon" => "exclamation-circle"),
    "rescues" =>  array("name" =>  "Rescues", "icon" => "ambulance"),
    "org_donations" =>  array("name" =>  "Donations", "icon" => "hand-holding-usd"),
    "news_events" =>  array("name" =>  "News & Events", "icon" => "calendar-alt"),
    "store" =>  array("name" =>  "Store", "icon" => "store-alt"),
    "client_reviews" =>  array("name" =>  "Client Reviews", "icon" => "thumbs-up"),
);

$administration_menu = array(
    "feedback" => array("name" => "Feedback", "icon" => "smile"),
    "organization_settings" =>  array("name" =>  "Settings", "icon" => "cog"),
    "help" =>  array("name" =>  "Help", "icon" => "question-circle"),
);

?>

<style>
    .settings-container {
        display: flex;
    }

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
        <div class="mx1">
                <a href="./dashboard.php" class="btn btn-link btn-icon mr1 " style="font-size: 1em;"><i class="fa fa-arrow-left"></i></a>
        </div>
        <div class="mx1">
            <h4 class="flex items-center">
                <a href="./dashboard.php" class="btn btn-link btn-icon mr1 " style="color: #313636; font-size: 1em;"><i class="fa fa-chart-line"></i></a>
                Dashboard
            </h4>
        </div>
        <div class="settings-container ">
            <div class="side-nav" style="font-size: 0.9em">
                <div class="mx1">
                    <h4 class="items-center mr1" style="color: #aaa6a1; font-size: 1em; font-weight: 400">
                        MANAGEMENT
                    </h4>
                </div>
                <?php foreach ($management_menu as $key => $value) { ?>
                    <a class="side-nav-link <?= $key == $active ? 'active' : '' ?>" href="?menu=<?= $key ?>">
                        <i class="fa fa-<?= $value["icon"] ?>"></i> &nbsp; <?= $value["name"] ?>
                    </a>
                <?php  } ?>

                <div class="mx1">
                    <h4 class="items-center mr1" style="color: #aaa6a1; font-size: 1em; font-weight: 400">
                        ADMINISTRATION
                    </h4>
                </div>

                <?php foreach ($administration_menu as $key => $value) { ?>
                    <a class="side-nav-link <?= $key == $active ? 'active' : '' ?>" href="?menu=<?= $key ?>">
                        <i class="fa fa-<?= $value["icon"] ?>"></i> &nbsp; <?= $value["name"] ?>
                    </a>
                <?php  } ?>

            </div>
            <div class="flex-auto mx2 " style="border: 1px solid var(--gray-4);border-radius: .5rem;">
                <?php include __DIR__ . "/org_dashboard/" . $active . ".php" ?>
            </div>
        </div>
    </div>
</div>