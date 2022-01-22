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
        width: 300px;
        height: 250px;
        top: 2.5rem;
        left: 8px;
        background: white;
        box-shadow: var(--shadow);
        z-index: 100;
        border-radius: 0.5rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-color: black;
    }

    .details {
        position: absolute;
        width: 300px;
        height: 200px;
        top: 20rem;
        left: 8px;
        background: white;
        box-shadow: var(--shadow);
        z-index: 50;
        border-radius: 0.5rem;
        padding-left: 1rem;
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
        transition-timing-function: ease-in-out;
        transition-delay: 2s;
        transition-duration: 0.5s;
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

        <?php foreach ($reported_cases as $reported_case) { ?>
            new google.maps.Marker({
                position: new google.maps.LatLng(<?= $reported_case["lat"] ?>, <?= $reported_case["longi"] ?>),
                map,
                title: 'Rescue Location'
            });
        <?php } ?>
    };

    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
</script>

<div style="position: relative;padding-top: 2rem;">
    <div class="cases_list">
        <div style="height:230px; overflow-x:hidden; overflow-y: auto;">
            <table class="table" style="text-align: center;">
                <tr>
                    <th>TYPE</th>
                    <!-- <th>INFO</th> -->
                    <th>STATUS</th>
                    <th></th>
                </tr>

                <?php foreach ($reported_cases as $reported_case) { ?>
                    <tr>
                        <td><?= $reported_case["type"] ?></td>
<!--                         <td>
                            <button onclick="showModel('popupModal<?= $reported_case["report_id"] ?>')" title="More Details" class="btn btn-link">Details</button>
                            <div id="popupModal<?= $reported_case["report_id"] ?>" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="hideModel('popupModal<?= $reported_case["report_id"] ?>')">&times;</span>
                                    <h3>More Details</h3>
                                    <table>
                                        <tr>
                                            <td>
                                                <div style="padding: 5px;"><button title="Time Reported" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-clock"></i>
                                            </td>
                                            <td><?= $reported_case["time_reported"] ?>&nbsp;<span class="tag <?= $reported_case["status"] == "PENDING" ? 'pink' : 'green' ?>"> <?= $reported_case["status"] ?> </span>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="padding: 5px;"><button title="Description" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-file-alt"></i></button>
                        </td>
                        <td><?= $reported_case["description"] ?></i> </button>
        </div>
        </td>
        </tr>
        <tr>
            <td>
                <div style="padding: 5px;"><button title="Contact Number" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-phone"></i></button>
            </td>
            <td><?= $reported_case["contact_number"] ?>
    </div>
    </td>
    </tr>
    <tr>
        <td>
            <div style="padding: 5px;"><button title="Location" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-map-marker-alt"></i></button>
        </td>
        <td><?= $reported_case["location"] ?>
</div>
</td>
</tr>
</table>

<div style="padding: 5px;" class="center"><img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 25%; height: 25%; border-radius: 5%;">&nbsp;<img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 25%; height: 25%; border-radius: 5%;">&nbsp;<img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 25%; height: 25%; border-radius: 5%;"></div>
</div>
</div>
</td> -->
<td>
    <div><span class="tag <?= $reported_case["status"] == "PENDING" ? 'pink' : ($reported_case["status"] == "RESCUED" ? 'green' : 'orange') ?>"> <?= $reported_case["status"] ?> </span></div>
</td>
<td>
    <div><button onclick="showModel('popupModal-confirm<?= $reported_case["report_id"] ?>')" class="btn btn-link green"><i class="<?= $reported_case["status"] == "PENDING" ? 'fas fa-check' : ''?>"></i>&nbsp;<?= $reported_case["status"] == "PENDING" ? 'Accept' : ''?></button></div>
    <div id="popupModal-confirm<?= $reported_case["report_id"] ?>" class="modal">
        <div class="modal-content" style="height: 150px; width: 250px; top: 40%; left: 45%">
            <span class="close" onclick="hideModel('popupModal-confirm<?= $reported_case["report_id"] ?>')">&times;</span>
            <h3 style="text-align: center;">Are you sure you want to confirm rescue?</h3>
            <button onclick="" class="btn green" style="position: absolute; right: 40px; bottom: 25px; width: 80px">Yes</button>
            <button class="btn" style="position: absolute; left: 40px; bottom: 25px; width: 80px; background-color: var(--gray-5); border-color: var(--gray-5);" onclick="hideModel('popupModal-confirm<?= $reported_case["report_id"] ?>')">Cancel</button>
        </div>
    </div>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>

<div class="details">
    <div style="height:180px; overflow-y: auto;">
        <h4>More Details</h4>
        <p style="font-size: small;"><?= $reported_case["description"] ?></p>
        <div style=""></div>
    </div>
</div>

<div class="rounded" style="height: 600px; width: 1250px; border-radius: .5rem;" id="googleMap"></div>
<div>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= config::get("maps.key") ?>&callback=myMap"></script>
</div>
</div>
</div>

<script>
    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(event) {
            if (event.target.classList.contains('modal') && !event.target.classList.contains('modal-content')) {
                let model = document.querySelector('.modal.shown');
                model.style.display = "none"
                model.classList.remove("shown")
                document.getElementById(id).onclick = null
            }
        }
    }

    function hideModel(id) {
        document.getElementById(id).classList.remove("shown")
        document.getElementById(id).style.display = "none";
        document.getElementById(id).onclick = null
    }
</script>