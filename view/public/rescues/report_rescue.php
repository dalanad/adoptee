<?php require __DIR__ . "./../../_layout/header.php"; ?>

<style>
    #googleMap {
        margin-bottom: 1rem;
    }

    .report {
        display: grid;
        margin: 0rem 1rem 3rem 1rem;
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
</style>

<div class="container ctx">
    <div class="report ">
        <h2 class="mt1">Report Injured Animals 
            <a class="btn red outline" style="float: right;" href="/view/emergency.php"><i class="fas fa-ambulance"></i>&nbsp; Emergency </a>
        </h2>
        <div class="field">
            <label>Description</label>
            <textarea rows="6" class="ctrl"></textarea>
            <span class="field-msg"> </span>
        </div>
        <div class="field ">
            <label>Where can we find this animal ? </label>
            <div class="ctrl-group">
                <span class="ctrl static"><i class="fa fa-map-marked-alt"></i></span>
                <input class="ctrl" type="location" />
                <button class="btn outline" onclick="getLocation()">Set Location</button>
            </div>
            <span class="field-msg"> </span>
        </div>
        <div class="rounded" style="min-height: 250px;" id="googleMap"></div>
        <div class="field ">
            <label>Photos</label>
            <div class="ctrl-group">
                <span class="ctrl static"><i class="fa fa-photo-video"></i></span>
                <input class="ctrl" type="file" multiple />
            </div>
            <span class="field-msg"> </span>
        </div>
        <div>
            <button class="btn my1 mb2">Report</button>
        </div>
    </div>
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


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN2HxM42eIrEG1e5b9ar2H_2_V6bMRjWk&callback=myMap"></script>