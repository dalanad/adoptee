<?php

$org_rescues = array(
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-01-2021", "contact_number" => "0771234567", "description" => "Injured Leg", "location" => "Anuradhapura", "photo" => "ABC")

);

?>


<style>
    .updates {
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
        width: 25%;
        position: fixed;
        top: 40%;
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

    .card-size {
        width: 95%;
        height: 20px;
     }  
</style>




<div style="top: 200px; padding-top: 0.5rem;">
    <div class="overflow-auto" style="height:550px">
    <div class="mouse-over-card card-size" style="display:flex; font-size: 0.8rem; font-weight: 500; border: none;">
                    <div style="width: 150px;">TYPE</div>
                    <div style="width: 180px;">DATE RESCUED</div>
                    <div style="width: 180px;">CONTACT NUMBER</div>
                    <div style="width: 250px;">DESCRIPTION</div>
                    <div style="width: 200px;">LOCATION</div>
                    <div style="width: 150px;">INFO</div>
                    <div style="width: 100px;"></div>
    </div>
            <?php foreach ($org_rescues as $org_rescue) { ?>
                    <div class="mouse-over-card card-size" style="display:flex;">
                    <div style="width: 150px;"><?= $org_rescue["type"] ?></div>
                    <div style="width: 180px;"><?= $org_rescue["date_rescued"] ?></div>
                    <div style="width: 180px;"><?= $org_rescue["contact_number"] ?></div>
                    <div style="width: 250px;"><?= $org_rescue["description"] ?></div>
                    <div style="width: 200px;"><?= $org_rescue["location"] ?></div>
                    
                    <div style="width: 150px;">
                    <button onclick="showModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                        <div id="popupModal<?= $org_rescue["org_rescue_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')">&times;</span>
                                <h3>Description</h3>
                                <?= $org_rescue["description"] ?>
                            </div>

                        </div>
                    </div>
                    <div style="width: 100px;"><a href="/OrgManagement/add_rescue_update" title="Add Update" class="btn btn-link btn-icon"><i class="fas fa-plus-circle"></i></a></div>
                

                    </div>
                    <br>
            <?php } ?>
    </div>
</div>

<script>
    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(rescue) {
            if (rescue.target.classList.contains('modal') && !rescue.target.classList.contains('modal-content')) {
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