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
</style>
<?php $pet = $petdata[0] ?>
<div class="container adoption-request">
    <div style="margin: 0 1rem;flex:1">
        <button class="btn btn-faded black" style="margin-bottom: 1rem;" onclick="history.back()"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>
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
                <?php for ($i = 'a'; $i < 'd'; $i++) {
                    $image = explode("/", $pet['photo'])[4]; ?>
                    <div class="thumbnail" style="background-image: url(../../../assets/data/<?= strtolower($pet['type']) ?>s/<?= explode(".", $image)[0] . $i ?>.<?= explode(".", $image)[1] ?>);cursor:pointer;" onclick="displayPreview(this)"> </div>
                <?php } ?>
            </div>
        </div>
        <div>
            <h4 style="margin: 0.5rem 0;">Description</h4>
            <?= $pet['description'] ?>
        </div>
    </div>

    <div style="position: relative;margin: 0 1rem;">
        <h3><i class="far fa-dog-leashed"></i>&nbsp; Adoption Request</h3>
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
        <?php if (isset($_SESSION['user'])){
            if (isset($req) && ($req[0]['status'] == "PENDING")) { //signed in; pet requested already
                if ($submission != NULL && ($submission[0]['user_id'] == $_SESSION['user']['user_id'])) { ?>
                    <!--signed in; pet requested by same user-->
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
                } else { ?>
                    <!--signed in; pet req by another user-->
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
            } elseif (isset($req) && ($req[0]['status'] == 'ADOPTED')) { ?>
                <div class="message">
                <div style="font-weight: 600;">It looks like this pet has already found a home</div></br>
                    <a href="/Adoptions" class="btn btn-link">Continue Browsing &nbsp <i class="fas fa-paw"></i></a>
                </div>
            <?php } else { ?>
                <!--not req at all-->
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
            <?php }
        } else { ?>
            <!--signed out-->
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
</script>