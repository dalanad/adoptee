<?php
$active = "medicine";
require_once  __DIR__ . '/_nav.php';
?>

<form action="/Doctor/save_medicine" method="post" style="max-width: 300px;">

    <?php if (isset($medicine["medicine_id"])) { ?>
        <h3>Edit Medicine</h3>
        <input type="hidden" name="medicine_id" value="<?= $medicine["medicine_id"] ?>">
    <?php } else { ?>
        <h3>New Medicine </h3>
    <?php }  ?>

    <div class="field">
        <label>Name</label>
        <input class="ctrl" type="text" name="name" value="<?= $medicine["name"] ?? "" ?>" required minlength="3">
    </div>

    <p>Recommendations</p>
    <div style="display: grid;grid-template-columns:1fr 1fr; grid-column-gap:1rem">

        <div class="field">
            <label>Age - Min</label>
            <div class="ctrl-group">
                <input class="ctrl" name="age_min" value="<?= $medicine["age_min"] ?? "" ?>" type="number" min="0">
                <span class="ctrl static">Years</span>
            </div>
        </div>

        <div class="field">
            <label>Age - Max</label>
            <div class="ctrl-group">
                <input class="ctrl" name="age_max" value="<?= $medicine["age_max"] ?? "" ?>" type="number" min="0">
                <span class="ctrl static">Years</span>
            </div>
        </div>

        <div class="field">
            <label>Weight - Min</label>
            <div class="ctrl-group">
                <input class="ctrl" name="weight_min" value="<?= $medicine["weight_min"] ?? "" ?>" type="number" min="0">
                <span class="ctrl static">Kg</span>
            </div>
        </div>

        <div class="field">
            <label>Weight - Max</label>
            <div class="ctrl-group">
                <input class="ctrl" name="weight_max" value="<?= $medicine["weight_max"] ?? "" ?>" type="number" min="0">
                <span class="ctrl static">Kg</span>
            </div>
        </div>

    </div>
    <br>
    <button class="btn" type="submit">Submit</button>
    <a href="javascript:history.back()" class="btn btn-link pink">Back</a>
</form>