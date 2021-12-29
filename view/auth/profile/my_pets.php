<style>
    .model {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .model-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        padding: 20px;
        border: 1px solid #888;
        position: fixed;
        top: 40%;
        left: 31%;
        max-height: calc(100vh - 210px);
        overflow-y: auto;
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

    .field {
        display: flex;
        margin-right: 1rem;
        margin-top: 2rem;
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
        width: 10rem;
    }

    input[type="date"] {
        width: 10.2rem;
    }

    .fa-trash {
        color: red;
    }

    th {
        color: var(--green);
    }

    caption {
        color: deeppink;
        font: bold;
    }

    .removed {
        height: 100%;
    }
</style>

<h3 style="margin-left:1rem;">My Pets</h3>
<!--Add new pet-->
<button class="btn right outline m2" onclick="showModel('popupmodel_add_pet')"> Add New Pet </button>
<div class="model" id="popupmodel_add_pet">
    <form action="/Profile/add_pet" method="post" class="model-content" style="width:fit-content;height:fit-content;top:10%;left:25%;" enctype="multipart/form-data">
        <span class="close" onclick="hideModel('popupmodel_add_pet')">&times;</span>
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
            <div class="field" style="flex:30%">
                <label for="gender">Gender</label>
                <div>
                    <input type="radio" name="gender" value="M" id="gender" class="ctrl-radio" required />&nbsp Male
                    <input type="radio" name="gender" value="F" id="gender" class="ctrl-radio" required />&nbsp Female
                </div>
            </div>

            <div class='field' style="flex:70%">
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

        <div style="display:flex;line-height:100%;">
            <div class='field' style="margin-right:3rem;">
                <label style="margin-top: 1rem; margin-bottom: 0.5rem;">Initial Vaccine</label>
                </br>
                <div class="vax">
                    <label for='anti_rabies'>Anti Rabies</label>&nbsp;
                    <input class="ctrl" type="file" name="anti_rabies" id="anti_rabies">
                    <!--max="?= getdate()['year'] ?>-?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>"-->
                </div>
                <div class="vax">
                    <label for='dhl'>DHL</label>&nbsp;
                    <input class="ctrl" type="file" name="dhl" id="dhl">
                </div>
                <div class="vax">
                    <label for='parvo'>Parvo</label>&nbsp;
                    <input class="ctrl" type="file" name="parvo" id="parvo">
                </div>
                <div class="vax">
                    <label for='tricat'>Tricat</label>&nbsp;
                    <input class="ctrl" type="file" name="tricat" id="tricat">
                </div>
                <div style="height:min-content">
                    <span class="field-msg">Select date only if vaccinated</span>
                </div>
            </div>

            <div class="field">
                <label style="margin-top: 1rem; margin-bottom: 0.5rem;">Yearly Booster</label>
                </br>
                <div class="vax">
                    <label for='anti_rabies_booster'>Anti Rabies Booster</label>&nbsp;
                    <input class="ctrl" type="file" name="anti_rabies_booster" id="anti_rabies_booster">
                </div>
                <div class="vax">
                    <label for='dhl_booster'>DHL Booster</label>&nbsp;
                    <input class="ctrl" type="file" name="dhl_booster" id="dhl_booster">
                </div>
                <div class="vax">
                    <label for='parvo_booster'>Parvo Booster</label>&nbsp;
                    <input class="ctrl" type="file" name="parvo_booster" id="parvo_booster">
                </div>
                <div class="vax">
                    <label for='tricat_booster'>Tricat Booster</label>&nbsp;
                    <input class="ctrl" type="file" name="tricat_booster" id="tricat_booster">
                </div>
                <div>
                    <span class="field-msg">Select date only if vaccinated this year</span>
                </div>
            </div>
        </div>

        <div class='field' style="line-height:100%;">
            <div>
                <label for='dewormed'>Dewormed</label>&nbsp;
                <input class="ctrl" type="file" name="dewormed" id="dewormed" max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>">
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
    <!--?php print_r($value); ?>-->
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

                                    <button onclick="showModel('popupmodelMedical<?= $value['animal_id'] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                                    <!-- Medical popup -->
                                    <div id="popupmodelMedical<?= $value["animal_id"] ?>" class="model">
                                        <div class="model-content">
                                            <span class="close" onclick="hideModel('popupmodelMedical<?= $value['animal_id'] ?>')">&times;</span>
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
                                                <caption>GENERAL</caption>
                                                <!--not taken from database-->
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
                                <?php if ($value['status'] == 'ACTIVE') { ?>
                                    <!--Edit pet details-->
                                    <td>
                                        <div onclick="showModel('popupmodel-edit<?= $value['animal_id'] ?>')" class="btn btn-link" title="Add New"><i class="fas fa-notes-medical"></i></div>
                                        <div id="popupmodel-edit<?= $value['animal_id'] ?>" class="model">
                                            <div class="model-content" style="max-height:100vh-10px;top:10%;left:35%;">
                                                <span class="close" onclick="hideModel('popupmodel-edit<?= $value['animal_id'] ?>')">&times</span>
                                                <form action="" method="POST">
                                                    <div style="display:flex">
                                                        <h3>Vaccination</h3><i class="fas fa-syringe" style="color:var(--red);"></i>
                                                    </div>
                                                    <div style="display:flex">
                                                        <div class="field">
                                                            <label for="vaccine">Vaccine name</label>
                                                            <input type="text" name="vaccine" id="proof" class="ctrl mb2" style="width:10rem;" />
                                                        </div>
                                                        <div class="field">
                                                            <label for="vax-proof">Proof of Vaccination</label>
                                                            <input type="file" name="vax-proof" id="vax-proof" class="ctrl" style="width:15rem;" />
                                                            <small class="field-hint">Upload a photo of proof of vaccination <br />that includes the veterinarian's signature and date</small>
                                                        </div>
                                                    </div>
                                                    <hr style="color:var(--primary);" /></br>
                                                    <div style="display:flex">
                                                        <h3>Medical Prescription</h3><i class="fas fa-prescription" style="color:var(--primary);"></i>
                                                    </div>
                                                    <div class="field">
                                                        <label for="prescription">Description</label>
                                                        <textarea name="prescription" id="prescription" class="ctrl mb2" style="max-width:100vh;"></textarea>
                                                    </div>
                                                    <div class="field" style="margin-top:0.3rem;">
                                                        <label for="prescription-proof">Proof of Vaccination</label>
                                                        <input type="file" name="prescription-proof" id="prescription-proof" class="ctrl" style="width:15rem;" />
                                                        <small class="field-hint">Upload a photo of the prescription <br />that includes the veterinarian's signature and date</small>
                                                    </div>
                                                    <button type="submit" class="btn mt2">Save</button>
                                                    <button type="reset" class="btn mt2 ml2">Clear</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php if ($value['status'] == 'ACTIVE') { ?>
                <div class="mt2">
                    <!--Remove pet-->
                    <div onclick="showModel('popupmodel-delete<?= $value['animal_id'] ?>')" class="btn btn-link" title="Remove Pet"><i class="fas fa-trash"></i></div>
                    <div id="popupmodel-delete<?= $value['animal_id'] ?>" class="model">
                        <form id="delete_form<?= $value['animal_id'] ?>" action="/Profile/delete_pet" method="post" class="model-content" style="width:20rem;text-align:center;">
                            <span class="close" onclick="hideModel('popupmodel-delete<?= $value['animal_id'] ?>')">&times;</span>
                            <h3>Are you sure you want to remove this pet from your pets list?</h3>
                            <div style="display:flex;justify-content:center;">
                                <button type="submit" class="btn btn-faded red mr2">Remove Pet</label>
                                    <input type="text" name="delete" value="<?= $value['animal_id'] ?>" style="display:none;" />
                                    <button type="button" class="btn btn-faded blue" onclick="hideModel('popupmodel-delete<?= $value['animal_id'] ?>')">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="mt2 btn btn-faded pink removed">REMOVED
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<script>
    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(event) {
            if (event.target.classList.contains('model') && !event.target.classList.contains('model-content')) {
                let model = document.querySelector('.model.shown');
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