<?php
require __DIR__ . "/../../_layout/layout.php";

?>
<form class="row" style=" max-width: 450px;margin: 0 auto;" action="/OrgSettings/<?= isset($user["user_id"]) ? "update_user" : "process_create_user" ?>" method="POST">
    <div style="padding: 1rem 1rem;display: flex;">
        <div style="flex: 1 1 0;"></div>
        <?= user_btn() ?>
    </div>
    <a class="btn btn-faded black" href="/OrgSettings/users"><i class="fa fa-chevron-left"></i> &nbsp; Back</a>
    <h3 style="margin: 1rem 0;"><?= isset($user["user_id"]) ? "Edit" : "New" ?> Organization User</h3>
    <div class="row" style="display: grid;grid-template-columns:1fr 1fr;grid-column-gap:1em">

        <div class="field">
            <label for="name">Name</label>
            <input class="ctrl" type="text" name="name" id="name" required value="<?= $user["name"] ?? "" ?>">
        </div>
        <div class="field">
            <?php
            if (isset($user["user_id"])) { ?>
                <input type="hidden" name="user_id" value="<?= $user["user_id"] ?>">
            <?php } else { ?>
                <label>Password</label>
                <input class="ctrl" type="password" autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" name="password" required>
                <small class="field-hint" title="Include upper & lower case letters,numbers and special characters ">Use a strong password</small>
            <?php }  ?>
        </div>
        <div class="field">
            <label for="name">Email Address</label>
            <input class="ctrl" type="text" name="email" id="email" required value="<?= $user["email"] ?? "" ?>">
        </div>
        <div class="field">
            <label>Mobile Phone Number</label>
            <input class="ctrl" type="text" name="telephone" pattern="07[0-9]{8}" required value="<?= $user["telephone"] ?? "" ?>">
            <small class="field-hint">Format : 07XXXXXXXX</small>
        </div>

    </div>
    <div>
        <button class="btn" type="submit">Submit</button><br><br>
    </div>
</form>