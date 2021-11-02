<?php require __DIR__ . "/../../_layout/header.php"; ?>

<!--removed arrow keys for amount-->
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .row {
        display: flex;
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

    #logo {
        max-width: 100%;
        max-height: 100%;
        border-radius: 5px;
    }
</style>

<div class='container px2'>
    <div style="display:flex;margin:1em;align-items:center;">
        <div class='placeholder-box mr1' style='height:100px; width:100px;'>
            <?php foreach ($details as $key => $value) { ?>
                <img src=<?= $value['logo'] ?> id="logo">
            <?php } ?>
        </div>
        <h2 class='mt1 txt-clr'>
            Donate to <?php foreach ($details as $key => $value) {
                            print_r($value['name']);
                        } ?>
        </h2>
    </div>

    <?php if (isset($_SESSION['user'])) { ?>
        <form action="/Organization/make_donation" method="POST">

            <div style="display:flex;">
                <div class='field'>
                    <label for="amount">Amount</label>
                    <input class="ctrl" type="number" name="amount" step="0.01" min="105.00" placeholder="0.00" style="width:8rem;" required>
                </div>

                <div class="field" style="display:flex;">
                    </br></br>
                    <div><input type="checkbox" value="NULL" name="subscribe" class="ctrl-check ml2" />&nbsp Subscribe</div>
                </div>
            </div>

            <p style="font-size:15px;">If you subscribe, the amount entered above will be donated to <?= $details[0]['name'] ?> periodically.
                The first donation will be made immediately, and monthly thereafter.</p>

            <div class='field'>
                <p>I would like to,</p>
                <div class="row">
                    <div class="column"><input type="checkbox" value="<?= $_SESSION['user']['name'] ?>" name="displayName" class="ctrl-check">&nbsp Display my name:</div>
                    <div class="column">
                        <?= $_SESSION['user']['name'] ?>
                    </div>
                </div>
            </div>

            <div class='field'>
                <div class="row">
                    <div class="column"><input type="checkbox" value="<?= $_SESSION['user']['email'] ?>" name="sendReceipt" class="ctrl-check">&nbsp Receive an emailed receipt:</div>
                    <div class="column">
                        <?= $_SESSION['user']['email'] ?>
                    </div>
                </div>
            </div>

            <p style="color:#ff0000; font-size:15px;">*If your personal details are incorrect, please visit your profile and update them
                <a class="btn btn-link" href="/profile/user_profile">here</a>
            </p>
            
            <input type="text" name="org_id" value="<?=$_GET['org_id']?>" style="display:none;">

            <button class='btn mr2' type="submit">Donate</button>
            <button class='btn mr2 btn-faded' type='reset'>Cancel</button>
        </form>
    <?php } else { ?>
        <div class="message">
            <i class="far fa-user-lock fa-5x txt-clr orange"></i> <br>
            <div style="font-weight: 600;"> Sign In Required</div> <br>
            <a class="btn green" href="/auth/sign_in">Sign In</a>
        </div>
    <?php } ?>


</div>