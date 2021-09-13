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




<div class="container" style="top: 100px">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        ADOPTEES
        <a href="/OrgManagement/add_new_animal" class="btn right outline"> Add New Animal </a>
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

            <?php foreach ($animals as $animal) { ?>
                <tr style="font-size: 0.8rem;">
                    <td>
                        <table>
                            <tr>
                                <td><img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                                <td><?= $animal["name"] ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?= $animal["type"] ?></td>
                    <td><?= $animal["dob"] ?></td>
                    <td><?= $animal["gender"] ?></td>
                    <td><?= $animal["date_listed"] ?></td>
                    <td><span class="tag <?= $animal["status"] == "ADOPTED" ? 'green' : 'pink' ?>"> <?= $animal["status"] ?> </span></td>
                    <td><?= $animal["date_adopted"] ?></td>
                    <td>
                        <button onclick="showModel('popupModal<?= $animal["animal_id"] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                        <div id="popupModal<?= $animal["animal_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal<?= $animal["animal_id"] ?>')">&times;</span>
                                <h3>Description</h3>
                                <?= $animal["description"] ?>
                            </div>

                        </div>
                    </td>
                    <td><button title="Edit" class="btn btn-link btn-icon"><i class="fas fa-pen"></i></button></td>
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