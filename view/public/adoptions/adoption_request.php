<?php require __DIR__ . "/../../_layout/header.php" ?>

<style>
    .adoption-request {
        display: flex;
        padding: 0 1rem;
        max-width: 1000px;
        box-sizing: border-box;
        justify-content: space-around;
    }

    @media (max-width:768px) {
        .adoption-request {
            flex-wrap: wrap;

        }
    }

    .images {
        max-width: 400px;
    }

    .thumbnails {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        white-space: nowrap;
    }

    .thumbnail {
        border-radius: 8px;
        background-size: cover;
        background-position: center;
        width: 60px;
        height: 70px;
        margin: .5rem .25rem;
        display: inline-block;
        border: var(--border);
    }

    .thumbnail:hover {
        transform: scale(1.1);
    }

    .images .avatar {
        border: var(--border);
        border-radius: 50%;
        background-size: cover;
        width: 50px;
        height: 50px;
    }

    .images .preview {
        border-radius: 8px;
        background-size: cover;
        width: 100%;
        border: var(--border);
        padding-top: 80%;
        background-position: center;
    }

    .row {
        display: flex;
        margin-bottom: .5rem;
        align-items: center;
    }

    .column {
        flex: 50%;
    }

    .message {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #ffffffcc;
        top: 0;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }

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

    .popup {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .vax_name {
        grid-column: 1;
        margin-bottom: 0.5rem;
    }

    .details {
        grid-column: 3;
    }

    .proof {
        width: 30rem;
        height: auto;

    }
</style>
<?php $pet = $petdata[0]; ?>

<div class="container adoption-request">

    <!-- Pet Info -->
    <div style="margin: 0 1rem;flex:1">
        <button class="btn btn-faded black" style="margin-bottom: 1rem;" onclick="location.href = '\\Adoptions';"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>
        <div class="images">
            <div style="margin-bottom: .5rem;display:flex">
                <img class="avatar" style="background-image: url(<?= $pet['photo'] ?>);">
                <div style="margin-left: .5rem;flex:1">
                    <div>
                        <b><?= $pet['name'] ?></b> &nbsp; <i class="txt-clr fa fa-<?= $pet['gender'] == "male" ? 'mars blue' : 'venus pink' ?>"></i>
                    </div>
                    <div style="font-size: .8em;">
                        <?= round($pet['age']) ?> Years old - <?= str_replace(array('[', ']', '"'), '', $pet['color']); ?> &nbsp;- <?= strtoupper($pet['type']) ?>
                    </div>
                    <div><small><span style="color: var(--gray-5);">Organization : </span> <?= $org[0]['name'] ?></small></div>
                </div>
            </div>
            <div class="preview" style="background-image: url(<?= $pet['photo'] ?>);"> </div>
            <div class="thumbnails">
                <div class="thumbnail" style="background-image: url(<?= $pet['photo'] ?>);cursor:pointer;" onclick="displayPreview(this)"> </div>
                <?php
                $photos = json_decode($pet['photos']);
                for ($i = 0; $i < sizeof($photos); $i++) { ?>
                    <div class="thumbnail" style="background-image: url(<?php if ($photos[$i][0] == '/') {
                                                                            echo '';
                                                                        } else {
                                                                            echo '/';
                                                                        }
                                                                        echo $photos[$i];
                                                                        ?>);
                                                cursor:pointer;" onclick="displayPreview(this)"> </div>
                <?php } ?>
            </div>
        </div>
        <div>
            <h4 style="margin: 0.5rem 0;">Description</h4>
            <?= $pet['description'] ?>
        </div>

        <div class="btn-link btn" onclick='showModel("health-records");'>
            <i class="fas fa-info-circle"></i>&nbsp;
            <h4>Health Records</h4>
        </div>

        <!-- Medical records popup -->
        <div id="health-records" class="model">
            <div class="model-content" style="width:fit-content;height:fit-content;top:10%;left:30%;">
                <span class="close" onclick='hideModel("health-records");'>&times;</span>

                <!-- Initial Vaccines -->
                <div class="popup" style="margin-top: 2rem;">
                    <h4 class="vax-name">Initial Vaccine</h4>
                    <h4 class="details">Date</h4>
                </div>
                <div class="popup">
                    <div class="vax_name">Anti-rabies</div>
                    <div class="details"><?= (isset($pet['anti_rabies']) && $pet['anti_rabies'] != 0) ? $pet['anti_rabies'] : '-' ?></div>
                </div>
                <div class="popup">
                    <div class="vax_name">Parvo</div>
                    <div class="details"><?= (isset($pet['parvo']) && $pet['parvo'] != 0) ? $pet['parvo'] : '-' ?></div>
                </div>
                <div class="popup">
                    <div class="vax_name"><?= $pet['type'] == 'Dog' ? 'DHL' : 'Tricat' ?></div>
                    <div class="details">
                        <?php if (isset($pet['dhl']) && $pet['dhl'] != 0) {
                            print_r($pet['dhl']);
                        } else if (isset($pet['tricat']) && $pet['tricat'] != 0) {
                            print_r($pet['tricat']);
                        } else echo '-' ?>
                    </div>
                </div>

                <!-- Boosters -->
                <div class="popup" style="margin-top: 2rem;">
                    <h4 class="vax-name">Last Booster Vaccine</h4>
                    <h4 class="details">Date</h4>
                </div>
                <div class="popup">
                    <div class="vax_name">Anti-rabies Booster</div>
                    <div class="details"><?= (isset($pet['anti_rabies_booster']) && $pet['anti_rabies_booster'] != 0) ? $pet['anti_rabies_booster'] : '-' ?></div>
                </div>
                <div class="popup">
                    <div class="vax_name">Parvo Booster</div>
                    <div class="details"><?= (isset($pet['parvo_booster']) && $pet['parvo_booster'] != 0) ? $pet['parvo_booster'] : '-' ?></div>
                </div>
                <div class="popup">
                    <div class="vax_name"><?= $pet['type'] == 'Dog' ? 'DHL Booster' : 'Tricat Booster' ?></div>
                    <div class="details">
                        <?php if (isset($pet['dhl_booster']) && $pet['dhl_booster'] != 0) {
                            print_r($pet['dhl_booster']);
                        } else if (isset($pet['tricat_booster']) && $pet['tricat_booster'] != 0) {
                            print_r($pet['tricat_booster']);
                        } else echo '-' ?>
                    </div>
                </div>

                <!-- Vaccination proof -->
                <h4 class="vax-name" style="margin-top: 2rem;">Proof of Vaccination</h4>
                <div style="width:fit-content;margin-right:1rem;">
                    <?php
                    $vacc =  json_decode($pet['vacc_proof']);
                    if (isset($vacc)) {
                        foreach ($vacc as $key => $value) { ?>
                            <img class="proof" src="/<?= $value ?>"></br>
                    <?php }
                    }
                    else{
                        echo '-';
                    } ?>
                </div>
            </div>
        </div>

    </div>

    <div style="position: relative;margin: 0 1rem;">
        <h3><i class="far fa-dog-leashed"></i>&nbsp; Adoption Request</h3>

        <!-- user info -->
        <div class="user-info">
            <div class="row">
                <div class="column bold">Name of adopter:</div>
                <div class="column"><?= isset($_SESSION['user']) ? $_SESSION['user']['name']  : ""; ?></div>
            </div>
            <div class="row">
                <div class="column bold">Contact Number:</div>
                <div class="column"><?= isset($_SESSION['user']) ? $_SESSION['user']['telephone'] : "" ?></div>
            </div>
            <div class="row">
                <div class="column bold">Email:</div>
                <div class="column"><?= isset($_SESSION['user']) ? $_SESSION['user']['email'] : "" ?></div>
            </div>
            <div class="row">
                <div class="column bold">Address:</div>
                <div class="column"><?= isset($_SESSION['user']) ? $_SESSION['user']['address'] : "" ?></div>
            </div>
            <p style="color:#ff0000;">If your personal details are incorrect, you can update them<a class="btn btn-link" href="/profile/user_profile">here</a></p>
        </div>

        <!-- signed in;  -->
        <?php if (isset($_SESSION['user'])) {

            // pet requested already
            if (($req != NULL) && ($req[0]['status'] == "PENDING")) {

                // pet requested by same user
                if (($submission != NULL) && ($submission[0]['user_id'] == $_SESSION['user']['user_id'])) { ?>

                    <br>
                    <h3 style="text-align:center;">Your request is pending approval</h3>
                    <br>
                    <h4>Copy of your adoption request-</h4>
                    <?php foreach ($submission as $key => $value) { ?>
                        <div class="row">
                            <div class="column bold">Are there other pets living in the same household? </div>
                            <div class="column"><?= $value['has_pets'] == '1' ? "Yes" : "No" ?></div>
                        </div>
                        <?php if ($value['has_pets'] == '1') { ?>
                            <div class="row">
                                <div class="column bold">Safety concerns regarding current pet(s) and adoptee:</div>
                                <div class="column"><?= $value['petsafety'] ?></div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="column bold">Are there children living in the same household?</div>
                            <div class="column"><?= $value['children'] == '1' ? "Yes" : "No" ?></div>
                        </div>
                        <?php if ($value['children'] == '1') { ?>
                            <div class="row">
                                <div class="column bold">Safety concerns regarding children and adoptee:</div>
                                <div class="column"><?= $value['childsafety'] ?></div>
                            </div>
                        <?php } ?>
                    <?php }
                }

                // pet req by another user
                else { ?>
                    <form action="/AdoptionRequest/submit?animal_id=<?= $_GET['animal_id'] ?>&org_id=<?= $_GET['org_id'] ?>" method="POST">
                        <div class='row'>
                            <label class="column" for="has_pets">Q. Do you own any pets?</label>
                            <div class="column ">
                                <label><input class="ctrl-radio" type="radio" value="1" name="has_pets" required onchange="displayPetSafety(this)" /> &nbspYes</label>
                                <label><input class="ctrl-radio" type="radio" value="0" name="has_pets" required onchange="displayPetSafety(this)" /> &nbspNo</label>
                            </div>
                        </div>
                        <div class='field' style="margin: 1rem 0;">
                            <label for="petsafety">If "Yes", what are the any safety concerns with adopting the requested pet, if any? </label>
                            <textarea rows="3" class="ctrl" name="petsafety" id="petsafety" disabled></textarea>
                        </div>
                        <div class='row'>
                            <div class="column">Q. Are there children living in the same household?</div>
                            <div class="column">
                                <label><input class="ctrl-radio" type="radio" value="1" name="children" required onchange="displayChildSafety(this)" /> &nbspYes &nbsp;</label>
                                <label><input class="ctrl-radio" type="radio" value="0" name="children" required onchange="displayChildSafety(this)" /> &nbspNo</label>
                            </div>
                        </div>
                        <div class='field' style="margin: 1rem 0;">
                            <label for="childsafety">If "Yes", what are the any safety concerns with adopting the requested pet, if any? </label>
                            <textarea rows="3" class="ctrl" name="childsafety" disabled></textarea>
                        </div>
                        <button style="margin-bottom: 1rem;" class='btn' type="submit">Request to Adopt</button>
                    </form>

                    <div class="message">
                        <div style="font-weight: 600;"><i class="fas fa-hourglass"></i> &nbsp Pending Adoption</div> <br>
                    </div>

                <?php }
            }

            // already adopted in the last 2 days
            elseif (($req != NULL) && ($req[0]['status'] == 'ADOPTED')) { ?>
                <div class="message">
                    <div style="font-weight: 600;">It looks like this pet has already found a home</div></br>
                    <a href="/Adoptions" class="btn btn-link">Continue Browsing &nbsp <i class="fas fa-paw"></i></a>
                </div>
            <?php }

            // not req at all
            else { ?>
                <form action="/AdoptionRequest/submit?animal_id=<?= $_GET['animal_id'] ?>&org_id=<?= $_GET['org_id'] ?>" method="POST">
                    <div class='row'>
                        <label class="column" for="has_pets">Q. Do you own any pets?</label>
                        <div class="column ">
                            <label><input class="ctrl-radio" type="radio" value="1" name="has_pets" required onchange="displayPetSafety(this)" /> &nbspYes</label>
                            <label><input class="ctrl-radio" type="radio" value="0" name="has_pets" required onchange="displayPetSafety(this)" /> &nbspNo</label>
                        </div>
                    </div>
                    <div class='field' style="margin: 1rem 0;">
                        <label for="petsafety">If "Yes", what are the any safety concerns with adopting the requested pet, if any? </label>
                        <textarea rows="3" class="ctrl" name="petsafety" id="petsafety" disabled></textarea>
                    </div>
                    <div class='row'>
                        <div class="column">Q. Are there children living in the same household?</div>
                        <div class="column">
                            <label><input class="ctrl-radio" type="radio" value="1" name="children" required onchange="displayChildSafety(this)" /> &nbspYes &nbsp;</label>
                            <label><input class="ctrl-radio" type="radio" value="0" name="children" required onchange="displayChildSafety(this)" /> &nbspNo</label>
                        </div>
                    </div>
                    <div class='field' style="margin: 1rem 0;">
                        <label for="childsafety">If "Yes", what are the any safety concerns with adopting the requested pet, if any? </label>
                        <textarea rows="3" class="ctrl" name="childsafety" disabled></textarea>
                    </div>
                    <button style="margin-bottom: 1rem;" class='btn' type="submit">Request to Adopt</button>
                </form>
            <?php
            }

            //signed out
        } else { ?>
            <div class="message">
                <i class="far fa-user-lock fa-5x txt-clr orange"></i> <br>
                <div style="font-weight: 600;"> Sign In Required</div> <br>
                <a class="btn green" href="/auth/sign_in">Sign In</a>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    function displayPetSafety(_this) {
        var text = document.getElementsByName('petsafety')[0];
        if (_this.value == "1") {
            text.disabled = false;
        } else {
            text.value = "";
            text.disabled = true;
        }
    }

    function displayChildSafety(_this) {
        var text = document.getElementsByName('childsafety')[0];
        if (_this.value == "1") {
            text.disabled = false;
        } else {
            text.value = "";
            text.disabled = true;
        }
    }

    function displayPreview(_this) {
        var prev = document.getElementsByClassName('preview')[0];
        var thumb = _this.style.backgroundImage;
        prev.style.backgroundImage = thumb;
    }

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
</script>