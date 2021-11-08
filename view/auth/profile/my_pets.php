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
        margin-right: 1rem;
    }

    .check {
        display: flex;
        flex-wrap: wrap;
    }

    .check input {
        display: none;
    }

    .check label {
        padding: 1rem;
        border: 2px solid var(--gray-3);
        display: block;
        border-radius: 50%;
        cursor: pointer;
        margin-right: .3rem;
        text-align: center;
        margin-bottom: .3rem;
    }

    .check input:checked+label {
        opacity: 0.5;
        border-color: var(--primary);
    }

    .vax {
        display: flex;
        height: 2rem;
        margin-bottom: 0.2rem;
    }

    .vax>label {
        width: 12rem;
    }

    input[type="date"] {
        width: 11rem;
    }

    .fa-trash {
        color: red;
    }

    th{
        color:var(--green);
    }

    caption{
        color:deeppink;
        font: bold;
    }

</style>

<h3 style="margin-left:1rem;">My Pets</h3>
<a href="#top" class="btn right outline m2"> Add New Pet </a>
<div class="expandable" id="top">
    <form action="/Profile/add_pet" method="post" class="m2">

        <div style="display: flex;">
            <div class="field">
                <label for="name">Name</label>
                <input class="ctrl ctrl2" type="text" name="name" id="name" required />
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

            <div class="field">
                <label for='other'>If Other:</label>
                <input class="ctrl" type="text" name="other" id="other" placeholder="Type" style="width:5rem;" />
            </div>

        </div>
        <div style="display: flex;">
            <div class="field" style="flex:40%">
                <label for="gender">Gender</label>
                <div>
                    <input type="radio" name="gender" value="M" id="gender" class="ctrl-radio" required />&nbsp Male
                    <input type="radio" name="gender" value="F" id="gender" class="ctrl-radio" required />&nbsp Female
                </div>
            </div>

            <div class='field' style="flex:60%">
                <label for='dob'>Approximate DOB</label>
                <div>
                    <input class="ctrl" type="date" style="width:11rem;" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>" name="dob" id="dob" onclick="ageCalculator()" required />
                    <p id="result"></p>
                </div>
            </div>
        </div>
        <div style="display:flex">
            <div class='field'>
                <label for="color"> Color </label>
                <div class="check">
                    <input id="white" name="color[]" type="checkbox" value="White">
                    <label for="white" style="background:cornsilk;" title="White"></label>
                    <input id="grey" name="color[]" type="checkbox" value="Grey">
                    <label for="grey" style="background:grey;" title="Grey"></label>
                    <input id="orange" name="color[]" type="checkbox" value="Orange">
                    <label for="orange" style="background:darkgoldenrod;" title="Orange"></label>
                    <input id="brown" name="color[]" type="checkbox" value="Brown">
                    <label for="brown" style="background:brown;" title="Brown"></label>
                    <input id="black" name="color[]" type="checkbox" value="Black">
                    <label for="black" style="background:black;color:white;" title="Black"></label>
                </div>
            </div>

            <div class="field" style="width:15rem;">
                <label for="photo">Photo:</label>
                <input class="ctrl" name="photo" type="file" required />
            </div>
        </div>

        <!-- <div style="display:flex;line-height:100%;"> -->
        <div class='field'>
            <label style="margin-top: 1rem; margin-bottom: 0.5rem;">Initial Vaccine</label>
            <div class="vax">
                <label for='anti_rabies'>Anti Rabies</label>&nbsp;
                <input class="ctrl" type="date" name="anti_rabies" id="anti_rabies" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div class="vax">
                <label for='dhl'>DHL</label>&nbsp;
                <input class="ctrl" type="date" name="dhl" id="dhl" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div class="vax">
                <label for='parvo'>Parvo</label>&nbsp;
                <input class="ctrl" type="date" name="parvo" id="parvo" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div class="vax">
                <label for='tricat'>Tricat</label>&nbsp;
                <input class="ctrl" type="date" name="tricat" id="tricat" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div style="height:min-content">
                <span class="field-msg">Select date only if vaccinated</span>
            </div>
        </div>

        <div class="field">
            <label style="margin-top: 1rem; margin-bottom: 0.5rem;">Yearly Booster</label>
            <div class="vax">
                <label for='anti_rabies_booster'>Anti Rabies Booster</label>&nbsp;
                <input class="ctrl" type="date" name="anti_rabies_booster" id="anti_rabies_booster" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div class="vax">
                <label for='dhl_booster'>DHL Booster</label>&nbsp;
                <input class="ctrl" type="date" name="dhl_booster" id="dhl_booster" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div class="vax">
                <label for='parvo_booster'>Parvo Booster</label>&nbsp;
                <input class="ctrl" type="date" name="parvo_booster" id="parvo_booster" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div class="vax">
                <label for='tricat_booster'>Tricat Booster</label>&nbsp;
                <input class="ctrl" type="date" name="tricat_booster" id="tricat_booster" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div>
                <span class="field-msg">Select date only if vaccinated this year</span>
            </div>
        </div>
        <!-- </div> -->

        <div class='field' style="line-height:100%;">
            <div>
                <label for='dewormed'>Dewormed</label>&nbsp;
                <input class="ctrl" type="date" name="dewormed" id="dewormed" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
            </div>
            <div>
                <span class="field-msg">Fill only if dewormed within the past 6 months</span>
            </div>
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
                                            <!--add vaccination history-->
                                            <?php if ($value['consultdata'] == NULL) { ?>
                                                <div style="text-align:center;font-size:medium;">No consultation history to show</div>
                                            <?php } else { ?>
                                                <table class="table">
                                                    <caption>CONSULTATION HISTORY</caption>
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
                                            <?php } ?>
                                            </br></br>
                                            <table class="table">
                                                <caption>GENERAL</caption> <!--not taken from database-->
                                                <tr>
                                                    <th>Anti Rabies Vaccination</th>
                                                    <th>Deworming</th>
                                                    <th>DHL Vaccination</th>
                                                </tr>
                                                <tr>
                                                    <td>2020-06-28</td>
                                                    <td>2020-08-14</td>
                                                    <td>2020-12-23</td>
                                                </tr>
                                                <tr>
                                                    <td>2021-06-03</td>
                                                    <td>2021-02-10</td>
                                                    <td></td>
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
            <div onclick="showModel('popupModal-delete')" class="btn btn-link" title="Remove Pet"><i class="far fa-trash"></i></div>
            <div id="popupModal-delete" class="modal">
                <div class="modal-content" style="width:20rem;text-align:center;">
                    <span class="close" onclick="hideModel('popupModal-delete')">&times;</span>
                    <h3>Are you sure you want to remove this pet from your pets list?</h3>
                    <div style="display:flex;justify-content:center;">
                        <button class="btn btn-faded red mr2" onclick="hideModel('popupModal-delete')">Remove Pet</button>
                        <button class="btn btn-faded blue" onclick="hideModel('popupModal-delete')">Cancel</button>
                    </div>
                </div>
            </div>
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