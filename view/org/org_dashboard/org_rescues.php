<?php

$org_rescues = array(
    array("type" => "Dog", "date_rescued" => "21-10-2021", "contact_number" => "0762457684", "description" => "Injured Leg", "location" => "12/1, Jayathilake Road, Anuradhapura", "photo" => "ABC"),
    array("type" => "Cat", "date_rescued" => "11-06-2021", "contact_number" => "0775467215", "description" => "Severe skin rash", "location" => "77/7, Silva Lane, Colombo 02", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "01-06-2019", "contact_number" => "0722247568", "description" => "Malnutritioned", "location" => "44/A, Bishop Road, Nugegoda", "photo" => "ABC"),
    array("type" => "Hamster", "date_rescued" => "26-10-2019", "contact_number" => "0771234567", "description" => "Spine Injurey", "location" => "151/3, Gregary Lane, Dehiwala", "photo" => "ABC"),
    array("type" => "Dog", "date_rescued" => "24-06-2018", "contact_number" => "071275645", "description" => "Abandoned near a highway", "location" => "Piliyandala, close to main road", "photo" => "ABC")

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

    .div-size {
        width: 95%;
        height: 20px;
     }  
</style>




<div style="padding-top: 2rem;">
    <div style="height:600px">
    <div class="div-size" style="display:flex; font-size: 0.8rem; font-weight: 500; border: none; padding-left: 1rem; padding-bottom: 1rem; padding-top:.5rem;">
                    <div style="width: 150px;">TYPE</div>
                    <div style="width: 180px;">DATE RESCUED</div>
                    <div style="width: 180px;">CONTACT NUMBER</div>
                    <div style="width: 250px;">DESCRIPTION</div>
                    <div style="width: 250px;">LOCATION</div>
                    <div style="width: 150px;">INFO</div>
                    <div style="padding-right: 0.5rem; width: 100px;"></div>
    </div>
    <div class="overflow-auto" style="height:525px">
            <?php foreach ($org_rescues as $org_rescue) { ?>
                    <div class="div-size" style="display:flex; padding-left: 1rem; padding-bottom: .5rem; padding-top:.5rem;">
                    <div style="width: 150px;"><i class="txt-clr fa fa-lg fa-<?= $org_rescue['type'] == "Dog" ? 'dog blue' : ($org_rescue['type'] == "Cat" ? 'cat pink' : 'paw green' ) ?>"></i>&nbsp;&nbsp; <?= $org_rescue["type"] ?></div>
                    <div style="width: 180px;"><?= $org_rescue["date_rescued"] ?></div>
                    <div style="width: 180px;"><?= $org_rescue["contact_number"] ?></div>
                    <div style="width: 250px;"><?= $org_rescue["description"] ?></div>
                    <div style="width: 250px;"><?= $org_rescue["location"] ?></div>
                    
                    <div style="width: 150px;">
                    <button onclick="showModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')" title="More Details" class="tag btn btn-link">Details</button>
                        <div id="popupModal<?= $org_rescue["org_rescue_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')">&times;</span>
                                <h3>Description</h3>
                                <?= $org_rescue["description"] ?>
                            </div>

                        </div>
                    </div>
                    <div style="padding-right: 0.5rem; width: 100px;"><a href="/OrgManagement/add_rescue_update" title="Add Update" class="btn btn-link" style="border-radius: 0.4rem; border: 0.1rem solid var(--primary);">Add Update</a></div>
                

                    </div>
                    <br>
            <?php } ?>
    </div>
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