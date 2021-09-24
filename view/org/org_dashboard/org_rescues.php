<?php

$org_rescues = array(
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

    .rescue{
        border-radius: 6px;
        background: white;
        box-shadow: var(--shadow-light);
        display: grid;
        min-height: 3rem;
        padding-top: 1em;
        padding-left: 1em;
        margin-bottom: 1em;
    }

    .rescue-card {
         text-align: center;
         padding: 1rem;
         border: 3px solid var(--gray-3);
         border-radius: 8px;
         cursor: pointer;
         position: relative;
        width: 95%;
        height: 20px;
        top: 10px;
        left: 10px;
        border-radius: 0.5rem;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 1rem;
     }

     .rescue-card:hover {
         transition: border-color .2s ease-in-out;
         border-color: var(--primary);
     }

     .rescue-card .btn {
         opacity: .2;
         transition: opacity .2s ease-in-out;
     }

     .rescue-card:hover .btn {
         opacity: 1;
     }

     .rescue-card .icon {
         font-size: 2em;
     }

     .rescue-card .title {
         font-size: 1.2rem;
         font-weight: 500;
         line-height: 1em;
     }
     
</style>




<div class="container" style="top: 200px;">
    <div class="overflow-auto" style="height:550px">
    <div class="rescue" style="display:flex;">
                    <div style="width: 100px;">TYPE</div>
                    <div style="width: 220px;">DATE RESCUED</div>
                    <div style="width: 270px;">CONTACT NUMBER</div>
                    <div style="width: 180px;">DESCRIPTION</div>
                    <div style="width: 180px;">LOCATION</div>
                    <div style="width: 100px;">INFO</div>
    </div>
            <?php foreach ($org_rescues as $org_rescue) { ?>
                    <div class="rescue-card" style="display:flex;">
                    <div style="width: 100px;"><?= $org_rescue["type"] ?></div>
                    <div style="width: 220px;"><?= $org_rescue["date_rescued"] ?></div>
                    <div style="width: 270px;"><?= $org_rescue["contact_number"] ?></div>
                    <div style="width: 180px;"><?= $org_rescue["description"] ?></div>
                    <div style="width: 180px;"><?= $org_rescue["location"] ?></div>
                    <div style="width: 100px;"><?= $org_rescue["photo"] ?></div>
                    
                    <div style="width: 60px;">
                    <button onclick="showModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                        <div id="popupModal<?= $org_rescue["org_rescue_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')">&times;</span>
                                <h3>Description</h3>
                                <?= $org_rescue["description"] ?>
                            </div>

                        </div>
                    </div>
                    <div style="width: 50px;"><a href="/OrgManagement/add_rescue_update" title="Add Update" class="btn btn-link btn-icon"><i class="fas fa-plus-circle"></i></a></div>
                

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