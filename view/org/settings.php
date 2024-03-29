<?php
require __DIR__ . "/../_layout/layout.php";

$menu_items = array(
    "general" => array("name" => "General", "icon" => "building"),
    "users" =>  array("name" =>  "Users", "icon" => "users"),
    "sponsorship" =>  array("name" =>  "Sponsors", "icon" => "hand-holding-heart"),
    "sponsorship_tiers" =>  array("name" =>  "Sponsorships Tiers", "icon" => "donate"),
);

if (!isset($active)) {
    $active = isset($_GET["menu"]) && isset($menu_items[$_GET["menu"]])  ? $_GET["menu"] : "general";
}

?>

<style>
    .settings-container {
        display: flex;
    }

    .side-nav {
        flex: 1 1 0;
        margin-left: 1rem;
        max-width: 12rem;
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
    <div style="padding: 1rem;align-items: flex-start;display: flex;">
        <div>
            <img style="max-height:50px" src="/assets/images/logo_vector_filled.svg" alt="Adoptee Logo" />
            <br>
            <div style="display:flex;align-items:center">
                <a href="/OrgManagement/org_adoption_listing" class="btn btn-faded black"><i class="fa fa-arrow-left"></i> &nbsp; Back</a> &nbsp; &nbsp;
                <h2 class="flex items-center">  &nbsp; <i class="far fa-cogs"></i> &nbsp; Organization Settings </h2>
            </div>
        </div>
        <div style="flex: 1 1 0;"></div>
        <?= user_btn() ?>
    </div>

    <div class="container">
        <div class="settings-container">
            <div class="side-nav">
                <?php foreach ($menu_items as $key => $value) { ?>
                    <a class="side-nav-link <?= $key == $active ? 'active' : '' ?>" href="/OrgSettings/<?= $key ?>">
                        <i class="fa fa-<?= $value["icon"] ?>"></i> &nbsp; <?= $value["name"] ?>
                    </a>
                <?php  } ?>
            </div>
            <div class="flex-auto   mx2 ">
                <?php include __DIR__ . "/org_settings/" . $active . ".php" ?>
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