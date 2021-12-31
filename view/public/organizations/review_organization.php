<?php require __DIR__ . "/../../_layout/header.php"; ?>

<style>
    .row {
        display: flex;
    }

    .column {
        flex: 50%;
    }

    .message {
        position: absolute;
        width: 50%;
        height: 100%;
        background: #ffffffcc;
        top: 10%;
        left: 30%;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }

    #logo {
        max-width: 100%;
        max-height: 100%;
        border-radius: 5px;
    }

    th,
    td {
        border: var(--gray-3) 2px solid;
        height: 2rem;
        width: 5rem;
    }

    .rate-check,
    .fa-check {
        display: none;
    }

    .fa-check {
        color: var(--primary);
    }

    .label {
        display: flex;
        height: 100%;
        align-items: center;
        justify-content: center;
    }

    .label:hover {
        cursor: pointer;
    }

    .label:hover>i {
        display: block;
        opacity: 0.3;
        transform: none;
    }

    input:checked+.label>i {
        display: block;
    }
</style>

<div class="container" style="max-width: 900px;">
    <div style="display:flex; margin: 1em; align-items:center">

        <div class="placeholder-box mr1" style=" height: 100px; width:100px; ">
            <?php foreach ($details as $key => $value) { ?> <img id="logo" src="<?= $value['logo'] ?>"> <?php } ?>
        </div>

        <div class="flex-auto">
            <div style="font-weight:500;font-size:1.5rem;">
                <?php foreach ($details as $key => $value) {
                    print_r($value['name']);
                } ?>
            </div>
            <div style="font-size:medium;">
                <?php foreach ($details as $key => $value) {
                    print_r($value['tagline']);
                } ?>
            </div>
        </div>

    </div>

    <?php if (isset($_SESSION['user'])) {
        $rating = array("Very Low", "Low", "Neutral", "Good", "Very Good");
        $criteria = array("Pet Living Conditions", "Pet Healthcare", "Rescue Report Response", "Adoption Request Handling", "Resource Allocation"); ?>
        <form action='/Organization/makeReview' method="post">
            <div class="field" style="margin-top:01rem;">
                <label>Satisfaction with organization-</label>
                <table class="table">
                    <!-- Rating headings -->
                    <tr>
                        <th style="border:none;"></th>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <th>
                                <?= $rating[$i] ?>
                            </th>
                        <?php } ?>
                    </tr>
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <tr>
                            <!-- Criteria headings -->
                            <td><?= $criteria[$i] ?></td>
                            <!-- Radio boxes -->
                            <?php for ($j = 1; $j < 6; $j++) { ?>
                                <td class="rate_box" style="padding:0;">
                                    <input type="radio" name="<?= $criteria[$i] ?>" class="rate-check" value="<?= $criteria[$i] . " " . $j ?>" id="<?= $criteria[$i] . " " . $rating[$j] ?>" />

                                    <label for="<?= $criteria[$i] . " " . $rating[$j] ?>" class="label">
                                        <i class="fas fa-check" style="text-align:center;"></i>
                                    </label>
                                </td>

                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="field" style="margin-top:01rem;">
                <label>Comments-</label>
                <textarea rows="6" class="ctrl" name="comment" placeholder="What should we improve?"></textarea>
            </div>

            <div class='field' style="margin-top:01rem;">
                <label>I would like to,</label>
                <div class="row">
                    <div class="column"><input type="checkbox" class="ctrl-check" value="1" name="name">&nbsp Display my name:</div>
                    <div class="column"><?= $_SESSION['user']['name'] ?></div>
                </div>
            </div>

            <div class='field'>
                <div class="row">
                    <div class="column"><input type="checkbox" class="ctrl-check" value="1" name="email">&nbsp Be contacted by the organization via email:</div>
                    <div class="column"><?= $_SESSION['user']['email'] ?></div>
                </div>
            </div>

            <p style="color:#ff0000; font-size:15px;">*If your personal details are incorrect, please visit your profile and update them
                <a class="btn btn-link" href="/profile/user_profile">here</a>
            </p>

            <input type="text" name="org_id" value="<?=$details[0]['org_id']?>" hidden />

            <button type="submit" class='btn mr2'>Submit Review</button>

        </form>
    <?php } else { ?>
        <div class="message">
            <i class="far fa-user-lock fa-5x txt-clr orange"></i> <br>
            <div style="font-weight: 600;"> Sign In Required</div> <br>
            <a class="btn green" href="/auth/sign_in">Sign In</a>
        </div>
    <?php } ?>
</div>

<script>
    function dispChecked(_this) {
        if (_this.nextElementSibling.checked = true) { //children[0].style.display == ''
            _this.children[0].style.display = "block";
            // _this.;
        } else if (_this.nextElementSibling.checked = false) {
            _this.children[0].style.display = "none";
            // _this.nextElementSibling.checked = false;
        }
    }

    // var check = document.getElementsByClassName('fa-check');
    // check.foreach(function(){
    //     check.AddEventL
    // })
</script>