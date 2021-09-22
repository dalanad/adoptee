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
        background: #fafafa;
        box-shadow: var(--shadow-light);
        display: grid;
        min-height: 3rem;
        padding-top: 1em;
        padding-left: 1em;
        margin-bottom: 1em;
    }
</style>




<div class="container" style="top: 200px;">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        Rescues
    </h3>
    <div class="overflow-auto" style="height: calc(100vh - 200px)">
        <table class="table">
            <tr>
                <th>TYPE</th>
                <th>DATE RESCUED</th>
                <th>CONTACT NUMBER</th>
                <th>DESCRIPTION</th>
                <th>LOCATION</th>
                <th>PHOTOS</th>
                <th>INFO</th>
                <th></th>
            </tr>

            <?php foreach ($org_rescues as $org_rescue) { ?>
                <tr style="font-size: 0.8rem;">
                    <div class="rescue">
                    <td><?= $org_rescue["type"] ?></td>
                    <td><?= $org_rescue["date_rescued"] ?></td>
                    <td><?= $org_rescue["contact_number"] ?></td>
                    <td><?= $org_rescue["description"] ?></td>
                    <td><?= $org_rescue["location"] ?></td>
                    <td><?= $org_rescue["photo"] ?></td>
                    <td>
                        <button onclick="showModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                        <div id="popupModal<?= $org_rescue["org_rescue_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')">&times;</span>
                                <h3>Description</h3>
                                <?= $org_rescue["description"] ?>
                            </div>

                        </div>
                    </td>
                    <td><a href="/OrgManagement/add_rescue_update" title="Add Update" class="btn btn-link btn-icon"><i class="fas fa-plus-circle"></i></a></td>
                

                    </div>
                    </tr>
            <?php } ?>

        </table>
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