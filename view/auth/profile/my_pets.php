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
</style>

<h3 style="margin-left:1rem;">My Pets</h3>
<a href="" class="btn right outline m2" onclick=newPet();> Add New Pet </a>
<!-- add new pet form -->

<?php
foreach ($petdata as $key => $value) { ?>
    <div class="card">
        <table class="table">
            <tr rowspan="4">
                <td><img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                <td>
                    <table>
                        <tr>
                            <td><?= $value["name"] ?></td>
                            <td><?= $value["age"] ?> Years Old</td>
                            <td><?= $value["gender"] ?></td>
                        </tr>
                        <tr>
                            <th>MEDICAL HISTORY</th>
                            <td>
                                <button onclick="showModel('popupModal<?= $consultdata['animal_id'] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                                <div id="popupModal<?= $consultdata["animal_id"] ?>" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="hideModel('popupModal<?= $consultdata['animal_id'] ?>')">&times;</span>
                                        <table>
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Doctor's Message</th>
                                            </tr>
                                            <tr>
                                                <td><?= $consultdata['consultation_date'] ?></td>
                                                <td><?= $consultdata['consultation_time'] ?></td>
                                                <td><?= $consultdata['message'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
<?php } ?>

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

    function newPet() {

    }
</script>