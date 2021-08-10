<?php


require_once  dirname(__FILE__) . './../../_layout/layout.php';

$data["header"]["nav"] = false;
$data["user"] = "Dalana";

require  dirname(__FILE__) . "./../../_layout/header.php";

$management_menu = array(
    "adoption_listing" => array("name" => "Adoption Listing", "icon" => "paw"),
    "adoption_request" =>  array("name" =>  "Adoption Requests", "icon" => "dog"),
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

$active = isset($_GET["menu"]) && isset($management_menu[$_GET["menu"]])  ? $_GET["menu"] : "general";
$active = isset($_GET["menu"]) && isset($administration_menu[$_GET["menu"]])  ? $_GET["menu"] : "general";

?>

<style>
    #googleMap {
        margin-bottom: 1rem;
    }

    .report {
        display: grid;
        margin: 0rem 1rem 3rem 1rem;
    }

    .cont-items-monitor {
position: absolute;
top: 60px;
left: 0;
bottom: 30px;
z-index: 1;
background-color: white;
overflow-x: scroll;
padding: 10px 15px 10px 0;
}

    @media (min-width:780px) {
        .report {
            grid-template-columns: 1fr 1fr;
            column-gap: 1rem;
            margin: 2rem;
        }

        #googleMap {
            grid-column: 1;
            grid-row: 1 / span 10;
            height: 100%;
        }
    }

    @media (min-width:1200px) {
        .ctx {
            height: calc(100% - 150px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    }
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
            <h4 class="flex items-center">
                <a href="/view/organization_dashboard.php" class="btn btn-link btn-icon mr1 " style="color: #313636; font-size: 1em;"><i class="fa fa-chart-line"></i></a>
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
            <script>
    var map

    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(6.9038086, 79.9110850),
            zoom: 12,
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    };

    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {

        var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
        map.setCenter(myLatlng);
        map.setZoom(15)
    }
</script>

<!-- <script>
    $(document).ready(function () {
    $('.cont-items-monitor').appendTo($('#google-map').find('div')[0]);
});
    </script>

<div class="cont-items-monitor">
<h4>ABC</h4>
</div>
 -->
 
<div class="rounded" style="height: 530px; width: 1255px" id="googleMap"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN2HxM42eIrEG1e5b9ar2H_2_V6bMRjWk&callback=myMap"></script>
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