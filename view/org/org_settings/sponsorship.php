<?php
$data["header"]["nav"] = false;
$data["user"] = "Dalana";

require __DIR__ . "./../../_layout/header.php";

$menu_items = array(
    "general" => array("name" => "General", "icon" => "building"),
    "users" =>  array("name" =>  "Users", "icon" => "users"),
    "sponsorships" =>  array("name" =>  "Sponsorships", "icon" => "donate"),
    "merchandise" =>  array("name" =>  "Merchandise", "icon" => "hat-wizard"),
    "payments" =>  array("name" =>  "Payments", "icon" => "money-check-alt"),
    "integrations" =>  array("name" =>  "Integrations", "icon" => "sync"),
);

$users = array(
    array("id" => 1, "name" => "Dalana ", "tier" => true,"sdate"=>"2021-05-06","status" => true),
    array("id" => 2, "name" => "Dalana", "tier" =>false ,"sdate"=>"2021-05-06", "status" => false),
    array("id" => 3, "name" => "Dalana", "tier" => true,"sdate"=>"2021-05-06", "status" => true),
    
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
        min-width: 10rem;
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
            .table th {
	text-transform: uppercase;
	font-size: 0.9rem;
}

    .table td{
        font-size:0.9rem;
    }
            </style>
<div class="container">
    <div class="mx2 txt-clr">
        <h2 class="flex items-center">
            <a href="/view/organization_dashboard.php" ></a>
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
                <div class="flex-auto   mx2 " style="padding:5px">
            <br>
            <span style="font-size:22px">Sponsorships</span>
            <table class="table">
    <tr>
        <th>Name</th>
        <th>Tier</th>
        <th>Start Date</th>
        <th>Status</th>
    </tr>

    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user["name"] ?></td>
            <td><span style="color: <?= $user["tier"] ? 'orange' : 'brown' ?>"><strong><?= $user["tier"] ? "Gold" : "Bronze" ?></strong></span> </td>
           
            <td><?= $user["sdate"] ?></td>
            <td><span style="color: <?= $user["status"] ? '#00FA9A' : 'red' ?>"><strong><?= $user["status"] ? "Active" : "Canceled" ?></strong></span> </td>

        </tr>
    <?php } ?>

</table>
