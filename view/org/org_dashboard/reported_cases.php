<?php

$reported_cases = array(
    array("type" => "Dog"),
    array("type" => "Cat"),
    array("type" => "Dog"),
    array("type" => "Cat"),
    array("type" => "Dog"),
    array("type" => "Cat"),
    array("type" => "Dog"),
    array("type" => "Cat")
);

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

    .cases_list{
        position: absolute;
        width: 350px; 
        height: 250px;
        top: 10px;
        left: 10px;
        background:white;
        box-shadow: var(--shadow);
        z-index: 100;
        border-radius: 0.5rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

.btn-link2 {
	color: #313636;
	background: no-repeat;
	border: none;
	min-height: 1em;
	box-shadow: none;
}

.btn-link3:focus {
	color: var(--green);
	background: no-repeat;
	border: none;
	min-height: 1em;
	box-shadow: none;
}

</style>

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
<div style="position: relative;">
    <div class="cases_list">
    <div style="height:240px; overflow-x:hidden; overflow-y: auto;">
        <table class="table" style="text-align: center;">
            <tr>
                <th style="font-size: 0.6rem;">TYPE</th>
                <th style="font-size: 0.6rem;">INFO</th>
                <th style="font-size: 0.6rem;">VIEW CONTACT</th>
                <th style="font-size: 0.6rem;">VIEW PHOTO</th>
                <th style="font-size: 0.6rem;">LOCATION</th>
                <th style="font-size: 0.6rem;">RESCUE</th>
            </tr>

            <?php foreach ($reported_cases as $reported_case) { ?>
                <tr style="font-size: 0.6rem;">
                    <td><?= $reported_case["type"] ?></td>
                    <td><button title="More Details" class="btn btn-link2 btn-icon"><i class="fas fa-info-circle"></i> </button></td>
                    <td><button title="mobile" class="btn btn-link2 btn-icon"><i class="fas fa-phone"></i> </button></td>
                    <td><button title="photo" class="btn btn-link2 btn-icon"><i class="fas fa-images"></i> </button></td>
                    <td><button title="location" class="btn btn-link2 btn-icon"><i class="fas fa-map-marker-alt"></i> </button></td>
                    <td><button title="rescue" class="btn btn-link btn-icon btn-link3"><i class="fas fa-check-circle"></i> </button></td>
                </tr>
            <?php } ?>

        </table>
    </div>
    </div>
    <div class="rounded" style="height: 500px; width: 1248px" id="googleMap"></div>
<div>
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