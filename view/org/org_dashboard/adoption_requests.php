<style>
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


<div style="padding-top: 0.5rem;">
    <div class="overflow-auto" style="height:600px; padding-top: 2rem;">

        <!-- Filters - Start -->
        <div style="padding-left: 1rem;">
            <form method="get" id="_form" style="display: flex;align-items:center;margin-bottom:1rem">
                <div>
                    <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="">
                    <button class="btn outline button-hover">Search</button>
                </div> &nbsp; | &nbsp;
                <div style="white-space: nowrap;">
                    <b>View :</b> &nbsp;
                    <input class="ctrl-radio" type="radio" name="status" value="ADOPTED" onchange='_form.submit()' <?= $filter['status'] == "ADOPTED" ? "checked" : "" ?>/> Adopted
                    <input class="ctrl-radio" type="radio" name="status" value="PENDING" onchange='_form.submit()' <?= $filter['status'] == "PENDING" ? "checked" : "" ?>/> Pending
                    <input class="ctrl-radio" type="radio" name="status" value="REJECTED" onchange='_form.submit()' <?= $filter['status'] == "REJECTED" ? "checked" : "" ?>/> Rejected
                    <input class="ctrl-radio" type="radio" name="status" value="ANY" onchange='_form.submit()' <?= $filter['status'] == "ANY" ? "checked" : "" ?>/> Any
                </div> &nbsp; | &nbsp;
                <div style="white-space: nowrap;">
                    <b>Sort by :</b> &nbsp;
                    <select class="ctrl field-font" name="sort" style="width: 65%;" onchange='_form.submit()'>
                        <option selected='true' disabled='disabled'>- Select -</option>
                        <option value='animal_name' <?= $filter['sort'] == 'animal_name' ? "selected" : "" ?>>Adoptee Name</option>
                        <option value='user_name' <?= $filter['sort'] == 'user_name' ? "selected" : "" ?>>Adoptor Name</option>
                        <option value='type' <?= $filter['sort'] == 'type' ? "selected" : "" ?>>Adoptee Type</option>
                        <option value='gender' <?= $filter['sort'] == 'gender' ? "selected" : "" ?>>Gender</option>
                        <option value='request_date' <?= $filter['sort'] == 'age' ? "selected" : "" ?>>Requested Date</option>
                    </select>
                </div> &nbsp;
                <div style="white-space: nowrap;">
                    <input class="ctrl-radio" type="radio" name="order" value="asc" onchange="_form.submit()" <?= $filter['order'] == 'asc' ? "checked" : "" ?>/> Asc
                    <input class="ctrl-radio" type="radio" name="order" value="desc" onchange="_form.submit()" <?= $filter['order'] == 'desc' ? "checked" : "" ?> /> Desc
                </div>
            </form>
        </div>
        <!-- Filters - End -->
        <br>

        <table class="table">
            <tr>
                <th>ADOPTEE</th>
                <th>ADOPTEE TYPE</th>
                <th>ADOPTER</th>
                <th>REQUEST DATE</th>
                <th>HAVE PETS</th>
                <th>HAVE CHILDREN</th>
                <th>STATUS</th>
                <th>INFO</th>
            </tr>

            <?php foreach ($adoption_requests as $adoption_request) { ?>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td><img src="<?= $adoption_request["photo"] ?>" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                                <td>
                                    <div>
                                        <div style="padding: 3px;"><?= $adoption_request["animal_name"] ?></div>
                                        <div style="padding: 3px;"><i class="txt-clr fa fa-lg fa-<?= $adoption_request['gender'] == "MALE" ? 'mars blue' : 'venus pink' ?>"></i></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td><?= $adoption_request["type"] ?></td>
                    <td><?= $adoption_request["user_name"] ?></td>
                    <td><?= $adoption_request["request_date"] ?></td>
                    <td><span class="tag <?= $adoption_request["has_pets"] ? 'green' : 'red' ?>"><?= $adoption_request["has_pets"] ? "YES" : "NO" ?> </span></td>
                    <td><span class="tag <?= $adoption_request["children"] ? 'green' : 'red' ?>"><?= $adoption_request["children"] ? "YES" : "NO" ?> </span></td>
                    <td><span class="tag <?= $adoption_request["status"] == "PENDING" ? 'orange' : ($adoption_request["status"] == "ADOPTED" ? 'green' : 'red')  ?>" title="<?= $adoption_request["status"] == "ACCEPTED" ? 'fas fa-check' : '' ?>"> <?= $adoption_request["status"] ?> </span></td>
                    <td>
                        <button onclick="showModel('popupModal<?= $adoption_request["animal_id"] ?>')" title="More Details" class="btn btn-link">Details</button>
                        <div id="popupModal<?= $adoption_request["animal_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $adoption_request["animal_id"] ?>')">&times;</span>
                                <h3>More Details</h3>
                                <div style="padding: 5px;"><button title="Adoptor Name" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-user"></i></button><?= $adoption_request["user_name"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Mobile" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-phone"></i></button><?= $adoption_request["contact"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Email" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-envelope"></i></button><?= $adoption_request["email"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Address" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-map-marker-alt"></i></button><?= $adoption_request["address"] ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if ($adoption_request["status"] != "ADOPTED") { ?>
                            <button onclick="showModel('popupModal-accept<?= $adoption_request["animal_id"] ?>')" class="btn btn-link btn-icon green"><i class="<?= $adoption_request["status"] == "PENDING" ? 'fas fa-check' : '' ?>"></i>&nbsp;<?= $adoption_request["status"] == "PENDING" ? 'Accept' : '' ?> </button>
                            <div id="popupModal-accept<?= $adoption_request["animal_id"] ?>" class="modal">
                                <div class="modal-content" style="height: 150px; width: 250px; top: 40%; left: 45%">
                                    <span class="close" onclick="hideModel('popupModal-accept<?= $adoption_request["animal_id"] ?>')">&times;</span>
                                    <h3 style="text-align: center;">Are you sure you want to accept request?</h3>
                                    <a href="/OrgManagement/accept_adoption_request?animal_id=<?= $adoption_request["animal_id"] ?>&user_id=<?= $adoption_request["user_id"] ?>" class="btn green" style="position: absolute; right: 40px; bottom: 25px; width: 80px">Yes</a>
                                    <button class="btn" style="position: absolute; left: 40px; bottom: 25px; width: 80px; background-color: var(--gray-5); border-color: var(--gray-5);" onclick="hideModel('popupModal-accept<?= $adoption_request["animal_id"] ?>')">Cancel</button>
                                </div>

                            </div>
                            &nbsp;
                            <button onclick="showModel('popupModal-reject<?= $adoption_request["animal_id"] ?>')" class="btn btn-link btn-icon red"><i class="<?= $adoption_request["status"] == "PENDING" ? 'fas fa-times' : '' ?>"></i>&nbsp;<?= $adoption_request["status"] == "PENDING" ? 'Reject' : '' ?></button>
                            <div id="popupModal-reject<?= $adoption_request["animal_id"] ?>" class="modal">
                                <div class="modal-content" style="height: 150px; width: 250px; top: 40%; left: 45%">
                                    <span class="close" onclick="hideModel('popupModal-reject<?= $adoption_request["animal_id"] ?>')">&times;</span>
                                    <h3 style="text-align: center;">Are you sure you want to reject request?</h3>
                                    <a href="/OrgManagement/reject_adoption_request?animal_id=<?= $adoption_request["animal_id"] ?>" class="btn red" style="position: absolute; right: 40px; bottom: 25px; width: 80px">Yes</a>
                                    <a class="btn" style="position: absolute; left: 40px; bottom: 25px; width: 80px; background-color: var(--gray-5); border-color: var(--gray-5);" onclick="hideModel('popupModal-reject<?= $adoption_request["animal_id"] ?>')">Cancel</a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <button onclick="showModel('popupModal-updates<?= $adoption_request["animal_id"] ?>')" title="View Updates" class="btn btn-link">View Updates</button>
                            <div id="popupModal-updates<?= $adoption_request["animal_id"] ?>" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="hideModel('popupModal-updates<?= $adoption_request["animal_id"] ?>')">&times;</span>
                                    <h3>Adoption Updates</h3>
                                    <table class="table">
                                        <tr>
                                            <th>UPDATE DATE</th>
                                            <th>TYPE</th>
                                            <th>DESCRIPTION</th>
                                            <th>PHOTO</th>
                                        </tr>
                                        <?php 
                                        $adoption_updates = OrgManagement::findUpdates($adoption_request["animal_id"],$adoption_request['user_id']);
                                        foreach ($adoption_updates as $adoption_update) { ?>
                                            <tr>
                                                <td><?= $adoption_update["update_date"] ?></td>
                                                <td><?= $adoption_update["type"] ?></td>
                                                <td><?= $adoption_update["description"] ?></td>
                                                <td>
                                                    <?php
                                                    $photos = json_decode($adoption_update['photo']);
                                                    foreach ($photos as $photo) { ?>
                                                        <div class="thumbnail" style="background-image: url(<?= $photo ?>);cursor:pointer;" onclick="displayPreview(this)"> eee </div>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>

                    </td>

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

    function showFlash() {
        window.FlashMessage.success('This is a successs flash message !');
    }
</script>