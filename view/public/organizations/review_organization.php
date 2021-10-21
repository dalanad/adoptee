<?php require __DIR__ . "/../../_layout/header.php"; ?>

<style>
    .row {
        display: flex;
    }

    .column {
        flex: 50%;
    }

    .message {
        text-align: center;
        margin-top: 15%;
        color: var(--primary);
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

    .rate-box:hover {
        cursor: pointer;
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
        <div class="field" style="margin-top:01rem;">
            <label>Satisfaction with organization-</label>
            <table class="table">
                <tr>
                    <th style="border:none;"></th>
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <th>
                            <?= $rating[$i] ?>
                        </th>
                    <?php } ?>
                </tr>
                <?php for ($i = 0; $i < 5; $i++) { ?>
                    <tr>
                        <td><?= $criteria[$i] ?></td>
                        <?php for ($j = 0; $j < 4; $j++) { ?>
                            <label for="<?= $criteria[$i] ." ". $rating[$j] ?>">
                                <td onclick="dispChecked(this)" class="rate-box">
                                    <i class="fas fa-check" style="text-align:center;"></i>
                                    <input type="radio" name="<?= $criteria[$i] ?>" class="rate-check" value="<?= $criteria[$i] . " " . $rating[$j] ?>" id="<?= $criteria[$i] ." ". $rating[$j] ?>" />
                                </td>
                            </label>
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
                <div class="column"><input type="checkbox" class="ctrl-check" value="yes" name="displayName">&nbsp Display my name:</div>
                <div class="column"><?= $_SESSION['user']['name'] ?></div>
            </div>
        </div>

        <div class='field'>
            <div class="row">
                <div class="column"><input type="checkbox" class="ctrl-check" value="yes" name="sendReply">&nbsp Be contacted by the organization via email:</div>
                <div class="column"><?= $_SESSION['user']['email'] ?></div>
            </div>
        </div>

        <p style="color:#ff0000; font-size:15px;">*If your personal details are incorrect, please visit your profile and update them
            <a class="btn btn-link" href="/profile/user_profile">here</a>
        </p>

        <button class='btn mr2'>Submit Review</button>

    <?php } else { ?>
        <div class="message">Please login to continue</div>
    <?php } ?>
</div>

<script>
    function dispChecked(_this) {
        if( _this.children[0].style.display==''){
            _this.children[0].style.display = "block";
            _this.children[1].checked = true;
        }
        else{
            _this.children[0].style.display = "none";
            _this.children[1].checked = false;
        }
    }

    // var check = document.getElementsByClassName('fa-check');
    // check.foreach(function(){
    //     check.AddEventL
    // })
</script>