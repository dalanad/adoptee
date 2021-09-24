
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

<div class="container">


    <div class="overflow-auto" style="height:550px">
        <table class="table">
            <tr>
                <th>ADOPTEE</th>
                <th>ADOPTEE TYPE</th>
                <th>ADOPTER</th>
                <th>HAVE PETS</th>
                <th>HAVE CHILDREN</th>
                <th>STATUS</th>
                <th>RESPOND REQUEST</th>
                <th>INFO</th>
            </tr>

            <?php foreach ($adoption_requests as $adoption_request) { ?>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td><img src="/assets\images\dogs/placeholder2.jpg" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                                <td><?= $adoption_request["name"] ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?= $adoption_request["type"] ?></td>
                    <td><?= $adoption_request["name"] ?></td>
                    <td><span class="tag <?= $adoption_request["has_pets"] ? 'green' : 'pink' ?>"><?= $adoption_request["has_pets"] ? "YES" : "NO" ?> </span></td>
                    <td><span class="tag <?= $adoption_request["children"] ? 'green' : 'pink' ?>"><?= $adoption_request["children"] ? "YES" : "NO" ?> </span></td>
                    <td><span class="tag <?= $adoption_request["status"] == "PENDING" ? 'orange' :($adoption_request["status"] == "ADOPTED" ? 'green' : 'red')  ?>"> <?= $adoption_request["status"] ?> </span></td>
                    <td>
                        <a href="/OrgManagement/accept_adoption_request?animal_id=<?= $adoption_request["animal_id"] ?>" title="Accept" class="btn btn-link btn-icon green"><i class="fas fa-check-circle"></i> </a>
                        &nbsp;
                        <a href="/OrgManagement/reject_adoption_request?animal_id=<?= $adoption_request["animal_id"] ?>" title="Reject" class="btn btn-link btn-icon pink"><i class="fas fa-times-circle"></i></a>
                    </td>
                    <td>
                        <button  onclick="showModel('popupModal<?= $adoption_request["animal_id"] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                        <div id="popupModal<?= $adoption_request["animal_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $animal["animal_id"] ?>')">&times;</span>
                                <h3>More Details</h3>
                                <div style="padding: 5px;"><button title="Adoptor Name" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-user"></i></button><?= $adoption_request["user_name"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Mobile" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-phone"></i></button><?= $adoption_request["contact"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Email" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-envelope"></i></button><?= $adoption_request["email"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Address" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-map-marker-alt"></i></button><?= $adoption_request["address"] ?></div>
                            </div>
                        </div>
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
</script>