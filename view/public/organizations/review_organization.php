<?php require __DIR__ . "/../../_layout/header.php"; ?>

<style>
    .row {
        display: flex;
    }

    .column {
        flex: 50%;
    }

    .columnBox {
        flex: 20%;
    }

    .message{
        text-align:center;
        margin-top:15%;
        color: var(--primary);
    }
</style>

<div class="container" style="max-width: 900px;">
    <div style="display:flex; margin: 1em; align-items:center">

        <div class="placeholder-box mr1" style=" height: 100px; width:100px; ">
            <?php foreach($details as $key=>$value){print_r($value['logo']);} ?>
        </div>

        <div class="flex-auto">
            <div style="font-weight:500;font-size:1.5rem;">
                <?php foreach($details as $key=>$value){print_r($value['name']);} ?>
            </div>
            <div style="font-size:medium;">
                <?php foreach($details as $key=>$value){print_r($value['tagline']);} ?>
            </div>
        </div>

    </div>

    <?php if(isset($_SESSION['user'])) {?>
    <div class="field" style="margin-top:01rem;">
        <label for="satisfaction">Satisfaction with organization-</label>
        <div class="row">
            <div class="columnBox">
                Very Low &nbsp<input type="radio" value="veryLow" name="satisfaction" class="ctrl-radio"></div>
            <div class="columnBox">
                Low &nbsp<input type="radio" value="low" name="satisfaction" class="ctrl-radio"></div>
            <div class="columnBox">
                Neutral &nbsp<input type="radio" value="neutral" name="satisfaction" class="ctrl-radio"></div>
            <div class="columnBox">
                Good &nbsp<input type="radio" value="good" name="satisfaction" class="ctrl-radio"></div>
            <div class="columnBox">
                Very Good &nbsp<input type="radio" value="veryGood" name="satisfaction" class="ctrl-radio"></div>
        </div>
    </div>

    <div class="field" style="margin-top:01rem;">
        <label>Comments-</label>
        <textarea rows="6" class="ctrl" name="comment" placeholder="What should we improve?"></textarea>
    </div>

    <div class='field' style="margin-top:01rem;">
        <label>I would like to,</label>
        <div class="row">
            <div class="column"><input type="checkbox" value="yes" name="displayName">&nbsp Display my name:</div>
            <div class="column"><?= $_SESSION['user']['name'] ?></div>
        </div>
    </div>

    <div class='field'>
        <div class="row">
            <div class="column"><input type="checkbox" value="yes" name="sendReply">&nbsp Be contacted by the organization via email:</div>
            <div class="column"><?= $_SESSION['user']['email']?></div>
        </div>
    </div>

    <p style="color:#ff0000; font-size:15px;">*If your personal details are incorrect,
        please visit your profile and update them</p>

    <button class='btn mr2'>Submit Review</button>

    <?php } else{ ?>
        <div class="message">Please login to continue</div>
    <?php } ?>
</div>