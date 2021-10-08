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
        width: 50%;
        position: fixed;
        top: 40%;
        left: 31%;
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

    .expandable {
        background: #fff;
        overflow: hidden;
        color: #000;
        line-height: 50px;

        transition: all .5s ease-in-out;
        height: 0;
    }

    .expandable:target {
        height: 20rem;
        overflow: scroll;
    }

    form {
        border-style: solid;
        border-right: none;
        border-left: none;
        padding: 1rem;
        border-color: var(--gray-3);
    }

    .field {
        display: flex;
        margin-right:1rem;
    }
</style>

<h3 style="margin-left:1rem;">My Pets</h3>
<a href="#top" class="btn right outline m2"> Add New Pet </a>
<div class="expandable" id="top">
    <form action="/Profile/add_pet" method="post" class="m2">

        <div style="display: flex;">
            <div class="field">
                <label for="name">Name</label>
                <input class="ctrl ctrl2" type="text" name="name" id="name" required/>
            </div>

            <div class="field">
                <label for="type">Type</label>
                <select class="ctrl" name="type" id="type" required>
                    <option>Dog</option>
                    <option>Cat</option>
                    <option>Bird</option>
                    <option>Other</option>
                </select>
            </div>


            <div class="field" style="display:flex;" id="gender">
                <label for="gender">Gender</label>
                <select name="gender" class="ctrl ctrl2" required>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </div>
        </div>

        <div class='field'>
            <label for='dob'>Approximate DOB</label>
            <div>
                <input class="ctrl" type="date" max="<?= getdate()['date'] ?>-<?= getdate()['month'] ?>-<?= getdate()['year'] ?>" name="dob" id="dob" onclick="ageCalculator()" required />
                <p id="result"></p>
            </div>
        </div>

        <div class="field">
            <label for="photo">Photo:</label>
            <input class="ctrl" name="photo" type="file" required/>
        </div>

        <button type="submit" class="btn mt2" style="height:2rem;">Add Pet</button>
        <a href='' type="reset" class="btn mt2 ml2" style="height:2rem;">Cancel</a>
    </form>
</div>

<?php
foreach ($petdata as $key => $value) { ?>
    <div class="card" style="margin-bottom:0.5rem;">
        <div style="display:flex;">
            <table class="table">
                <tr rowspan="4">
                    <td><img src="../../../<?= $value['photo'] ?>" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                    <td>
                        <table>
                            <tr>
                                <td><?= $value["name"] ?></td>
                                <td><?= $value["age"] ?> Years Old</td>
                                <td><?= $value["gender"] ?></td>
                            </tr>
                            <tr>
                                <td class='bold' style='font-size:0.9rem;'>MEDICAL HISTORY

                                    <button onclick="showModel('popupModal<?= $value['animal_id'] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                                    <div id="popupModal<?= $value["animal_id"] ?>" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="hideModel('popupModal<?= $value['animal_id'] ?>')">&times;</span>
                                            <table class="table">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Doctor's Message</th>
                                                </tr>
                                                <?php foreach ($value['consultdata'] as $consultation) { ?>
                                                    <tr>
                                                        <td><?= $consultation['consultation_date'] ?></td>
                                                        <td><?= $consultation['consultation_time'] ?></td>
                                                        <td><?= $consultation['message'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div class="btn btn-link" title="Remove Pet"><i class="far fa-trash" style="color:red;"></i></div>
        </div>
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