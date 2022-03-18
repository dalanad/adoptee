<?php
$active = "medicine";
require_once  __DIR__ . '/_nav.php';
?>

<form action="/Doctor/save_medicine" method="post" style="max-width: 300px;">

    <?php if (isset($medicine["medicine_id"])) { ?>
        <input type="hidden" name="medicine_id" value="<?= $medicine["medicine_id"] ?>">
    <?php } ?>

    <div class="field">
        <label>Name</label>
        <input class="ctrl" type="text" name="name" value="<?= $medicine["name"] ?? "" ?>" required minlength="3">
    </div>

    <button class="btn" type="submit">Submit</button>
    <a href="javascript:history.back()" class="btn btn-link pink">Back</a>
</form>