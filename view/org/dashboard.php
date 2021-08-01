<?php


require_once  dirname(__FILE__) . './_layout/layout.php';

$data["header"]["nav"] = false;
$data["user"] = "Dalana";

require  dirname(__FILE__) . "./_layout/header.php";

$menu_items = array(
    "Add Animal for Adoption" => array("name" => "Add Animal for Adoption", "icon" => "paw"),
    "Adoption Requests" =>  array("name" =>  "Adoption Requests", "icon" => "file-alt"),
    "Reported Cases" =>  array("name" =>  "Reported Cases", "icon" => "exclamation-circle"),
    "News & Events" =>  array("name" =>  "News & Events", "icon" => "calendar-alt"),
    "Store" =>  array("name" =>  "Store", "icon" => "store-alt"),
    "Client Reviews" =>  array("name" =>  "Client Reviews", "icon" => "thumbs-up"),
);

$active = isset($_GET["menu"]) && isset($menu_items[$_GET["menu"]])  ? $_GET["menu"] : "general";

?>

<style>
    .settings-container {
        display: flex;
    }

    .side-nav {
        flex: 1 1 0;
        margin-left: 1rem;
        min-width: 15rem;
        max-width: 10rem;
        display: flex;
        flex-direction: column;
    }

    .side-nav-link {
        display: block;
        padding: 0.6em 0.5em;
        margin-bottom: 0.6em;
        background: var(--gray-1);
        text-decoration: none;
        color: #858585;
        line-height: 0.9;
        font-weight: 500;
        border: .2rem solid var(--gray-1);
        border-radius: 8px;
        white-space: nowrap;
        scroll-margin: 0.6em;
    }

    .side-nav-link:hover {
        transition: background .3s ease-in-out, border-color .3s ease-in-out, color .2s ease-in-out;
        background: transparent;
        border-color: var(--gray-4);
    }

    .side-nav-link.active {
        border-color: var(--primary);
        color: var(--primary);
        background: transparent;

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

<div class="container">
    <div class="mx2 txt-clr">
        <h2 class="flex items-center">
            <a href="/view/organization_dashboard.php" class="btn btn-link btn-icon mr1 " style="font-size: 1em;"><i class="fa fa-arrow-left"></i></a>
            Organization Dashboard
        </h2>
    </div>
    <div class="container">
        <div class="settings-container ">
            <div class="side-nav">
                <?php foreach ($menu_items as $key => $value) { ?>
                    <a class="side-nav-link <?= $key == $active ? 'active' : '' ?>" href="?menu=<?= $key ?>">
                        <i class="fa fa-<?= $value["icon"] ?>"></i> &nbsp; <?= $value["name"] ?>
                    </a>
                <?php  } ?>
            </div>
            <div class="flex-auto   mx2 " style="border: 1px solid var(--gray-4);border-radius: .5rem">
                <?php include "./org_settings/" . $active . ".php" ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector(".side-nav .active").scrollIntoView({
        behavior: 'auto',
        block: 'center',
        inline: 'center'
    });
</script>