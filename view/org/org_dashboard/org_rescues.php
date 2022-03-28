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
    <!-- Filters - Start -->
    <div style="padding-left: 1rem;">
        <form method="get" id="_form" style="display: flex;align-items:center;margin-bottom:1rem">
            <div>
                <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="">
                <button class="btn outline button-hover">Search</button>
            </div> &nbsp; | &nbsp;
            <div style="white-space: nowrap;">
                <b>Sort by :</b> &nbsp;
                <select class="ctrl field-font" name="sort" style="width: 65%;"  onchange='_form.submit()'>
                    <option selected='true' disabled='disabled'>- Select -</option>
                    <option value='type' <?= $filter['sort'] == 'type' ? "selected" : "" ?>>Animal Type</option>
                    <option value='rescued_date' <?= $filter['sort'] == 'rescued_date' ? "selected" : "" ?>>Date Rescued</option>
                </select>
            </div> &nbsp;
            <div style="white-space: nowrap;">
                <input class="ctrl-radio" type="radio" name="order" value="asc"  onchange="_form.submit()" <?= $filter['order'] == 'asc' ? "checked" : "" ?> /> Asc
                <input class="ctrl-radio" type="radio" name="order" value="desc"  onchange="_form.submit()" <?= $filter['order'] == 'desc' ? "checked" : "" ?> /> Desc
            </div>
        </form>
    </div>
    <!-- Filters - End -->

    <div style="height:600px">
        <div class="div-size" style="display:flex; font-size: 0.8rem; font-weight: 500; border: none; padding-left: 1rem; padding-bottom: 1rem; padding-top:.5rem;">
            <div style="width: 120px;">TYPE</div>
            <div style="width: 150px;">DATE RESCUED</div>
            <div style="width: 150px;">CONTACT NUMBER</div>
            <div style="width: 220px;">DESCRIPTION</div>
            <div style="width: 220px;">LOCATION</div>
            <div style="width: 120px;">INFO</div>
            <div style="width: 120px;">ACTION</div>
            <div style="padding-right: 0.5rem; width: 100px;"></div>
        </div>
        <div class="overflow-auto" style="height:525px">
            <?php foreach ($org_rescues as $org_rescue) { ?>
                <div class="div-size" style="display:flex; padding-left: 1rem; padding-bottom: .5rem; padding-top:.5rem;">
                    <div style="width: 120px;"><i class="txt-clr fa fa-lg fa-<?= $org_rescue['type'] == "Dog" ? 'dog' : ($org_rescue['type'] == "Cat" ? 'cat' : 'paw') ?>"></i>&nbsp;&nbsp; <?= $org_rescue['type'] ?></div>
                    <div style="width: 150px;"><?= date('Y-m-d', strtotime($org_rescue["rescued_date"])) ?></div>
                    <div style="width: 150px;"><?= $org_rescue["contact_number"] ?></div>
                    <div style="width: 220px;"><?= $org_rescue["description"] ?></div>
                    <div style="width: 220px;"><?= $org_rescue["location"] ?></div>

                    <div style="width: 120px;">
                        <button onclick="showModel('popupModal<?= $org_rescue["org_rescue_id"] ?>')" title="More Details" class="btn btn-link">Details</button>
                        <div id="popupModal<?= $org_rescue["report_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $org_rescue["report_id"] ?>')">&times;</span>
                                <h3>Description</h3>
                                <?= $org_rescue["description"] ?>
                            </div>

                        </div>
                    </div>

                 

                    <div style="padding-right: 0.5rem; width: 120px;">
                    
                    <?php if($org_rescue["status"] == "RESCUED") {?> 
                        <a href="/OrgManagement/add_new_animal?report_id=<?=$org_rescue["report_id"]?>" class="btn btn-link btn-icon orange"><i class="fas fa-plus"></i>&nbsp;New Animal</button>
                    <?php } else { ?>    
                    
                    <button onclick="showModel('popupModal-accept<?= $org_rescue["report_id"] ?>')" class="btn btn-link btn-icon <?= $org_rescue["status"] <> "RESCUED" ? 'green' : '' ?>"><i class="fas fa-check"></i>&nbsp;<?= $org_rescue["status"] <> "RESCUED" ? 'Complete' : '' ?> </button>
                        <div id="popupModal-accept<?= $org_rescue["report_id"] ?>" class="modal">
                            <div class="modal-content" style="height: 150px; width: 250px; top: 40%; left: 45%">
                                <span class="close" onclick="hideModel('popupModal-accept<?= $org_rescue["report_id"] ?>')">&times;</span>
                                <h3 style="text-align: center;">Are you sure you want to mark rescue as complete?</h3>
                                <a href="/OrgManagement/mark_as_complete?report_id=<?= $org_rescue["report_id"] ?>&user_id=<?= $org_rescue["user_id"] ?>" class="btn green" style="position: absolute; right: 40px; bottom: 25px; width: 80px">Yes</a>
                                <button class="btn" style="position: absolute; left: 40px; bottom: 25px; width: 80px; background-color: var(--gray-5); border-color: var(--gray-5);" onclick="hideModel('popupModal-accept<?= $org_rescue["report_id"] ?>')">Cancel</button>
                            </div>

                        </div>
                        <?php } ?>
                    </div>

                    <div style="padding-right: 0.5rem; width: 100px;"><a href="/OrgManagement/add_rescue_update?report_id=<?=$org_rescue["report_id"]?>" title="Add Update" class="btn btn-link" style="border-radius: 0.4rem; border: 0.1rem solid var(--primary);">Add Update</a></div>


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