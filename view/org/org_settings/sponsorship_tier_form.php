<?php require __DIR__ . "/../../_layout/layout.php";
?>
<style>
    .center {
        padding-top: 40px;
        text-align: center;
        font-size: 25px;
    }

    .sec {
        width: 30%;
        margin: auto;
        padding-top: 30px;
    }

    .section {

        width: 30%;
        margin: auto;

    }
</style>
<form class="container" action="/OrgSettings/process_<?= isset($tier) ? 'edit' : 'create' ?>_sponsorship_tier" method="POST">
    <div style="padding: 1rem 1rem;display: flex;">
        <div style="flex: 1 1 0;"></div>
        <?= user_btn() ?>
    </div>
    <div class="center">
        <strong>Sponsorship Tier</strong>
    </div>
    <div class="section">
        <?php if (isset($tier) && isset($tier["name"])) { ?>
            <input type="hidden" name="old_name" value="<?= $tier["name"] ?>" required>
        <?php } ?>
        <div class="field">
            <label for="name">Name</label>
            <input class="ctrl" type="text" name="name" id="name" value="<?= $tier["name"] ?? '' ?>" required>
        </div>
        <div class="field">
            <label for="contribution">Description</label>
            <textarea class="ctrl" id="description" maxlength="490" name="description" required style="height:200px"><?= $tier["description"] ?? '' ?></textarea>
        </div>
        <div class="field">
            <label for="amount">Amount</label>
            <div class="ctrl-group">
                <span class="ctrl static">Rs.</span>
                <input class="ctrl" type="number" name="amount" id="amount" style="text-align: right;" value="<?= $tier["amount"] ?? '' ?>" required>
                <span class="ctrl static">.00</span>
            </div>
        </div>
        <div class="field">
            <label> Period </label>
            <select class="ctrl" type="number" name="recurring_days" required>
                <option <?= isset($tier) && $tier["recurring_days"] == "7" ? 'selected' : '' ?> value="7"></option>
                <option <?= isset($tier) ? '' : 'selected' ?> <?= isset($tier) && $tier["recurring_days"] == "30" ? 'selected' : '' ?> value="30">Monthly</option>
                <option <?= isset($tier) && $tier["recurring_days"] == "180" ? 'selected' : '' ?> value="182">Bi-Annually</option>
                <option <?= isset($tier) && $tier["recurring_days"] == "365" ? 'selected' : '' ?> value="365">Annually</option>
            </select>
        </div>
        <div>
            <button class="btn">Save</button>
        </div>
        <div class="sec">
            <a class="btn btn-faded pink" href="/OrgSettings/sponsorships">Go Back</a>
        </div>
    </div>

</form>
 
