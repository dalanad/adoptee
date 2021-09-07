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
</style>




<div class="container" style="top: 100px">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        Rescues
        <a href="/OrgManagement/add_new_org_rescue" class="btn right"> Add New org_rescue </a>
    </h3>
    <div class="overflow-auto" style="height:450px">
        <table class="table">
            <tr>
                <th>PET</th>
                <th>TYPE</th>
                <th>AGE</th>
                <th>GENDER</th>
                <th>DATE LISTED</th>
                <th>STATUS</th>
                <th>DATE ADOPTED</th>
                <th>INFO</th>
                <th></th>
            </tr>

            <?php foreach ($org_rescues as $org_rescue) { ?>
                <div>
                <tr style="font-size: 0.8rem;">
                    <td><?= $org_rescue["animal_id"] ?></td>
                    <td><?= $org_rescue["rescued_date"] ?></td>
                    <td><?= $org_rescue["dob"] ?></td>
                    <td><?= $org_rescue["gender"] ?></td>
                    <td><?= $org_rescue["date_listed"] ?></td>
                    <td><span class="tag <?= $org_rescue["status"] == "ADOPTED" ? 'green' : 'pink' ?>"> <?= $org_rescue["status"] ?> </span></td>
                    <td><?= $org_rescue["date_adopted"] ?></td>
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
                </tr>
            </div>
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