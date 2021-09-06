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

    .cases_list {
        position: absolute;
        width: 250px;
        height: 250px;
        top: 10px;
        left: 10px;
        background: white;
        box-shadow: var(--shadow);
        z-index: 100;
        border-radius: 0.5rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-color: black;
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

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        position: fixed;
        top: 20%;
        left: 35%;

    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
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
                    <th style="font-size: 0.8rem;">TYPE</th>
                    <th style="font-size: 0.8rem;">LOCATION</th>
                    <th style="font-size: 0.8rem;">INFO</th>
                    <th style="font-size: 0.8rem;">RESCUE</th>
                </tr>

                <?php foreach ($reported_cases as $reported_case) { ?>
                    <tr style="font-size: 0.8rem;">
                        <td><?= $reported_case["type"] ?></td>
                        <td><button title="location" class="btn btn-link btn-icon"><i class="fas fa-map-marker-alt"></i></button></td>
                        <td>
                            <button id="popupBtn" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                            <div id="popupModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <h3>More Details</h3>
                                    <table>
                                        <tr><td><div style="padding: 5px;"><button title="Time Reported" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-file-clock"></i><?= $reported_case["time_reported"] ?>&nbsp;<span class="tag <?= $reported_case["status"] == "PENDING" ? 'pink' : 'green' ?>"> <?= $reported_case["status"] ?> </span></div>
                                        <tr><td><div style="padding: 5px;"><button title="Description" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-file-alt"></i></button></td><td><?= $reported_case["description"] ?></i> </button></div></td></tr>
                                        <tr><td><div style="padding: 5px;"><button title="Contact Number" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-phone"></i></button></td><td><?= $reported_case["contact_number"] ?></div></td></tr>
                                        <tr><td><div style="padding: 5px;"><button title="Location" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-map-marker-alt"></i></button></td><td><?= $reported_case["location"] ?></div></td></tr>
                                    </table>
                                    <div style="padding: 5px;" class="center"><img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 25%; height: 25%; border-radius: 5%;">&nbsp;<img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 25%; height: 25%; border-radius: 5%;">&nbsp;<img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 25%; height: 25%; border-radius: 5%;"></div>
                                </div>
                            </div>
                        </td>
                        <td><div><a class="btn btn-link btn-icon" style="font-size: 0.8rem;" href="/OrgManagement/updateRescueReportStatus"><span class="tag <?= $reported_case["org_response"] == "RESCUE" ? 'pink' : 'green' ?>"> <?= $reported_case["org_response"] ?> </span></a></div></td>
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

    var modal = document.getElementById("popupModal");
    var btn = document.getElementById("popupBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>