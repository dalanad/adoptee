<?php require_once __DIR__ . "/../../_layout/layout.php" ?>



<style>
    .row {
        display: flex;
    }

    .column {
        margin-right: 1rem;
        flex: 50%;
    }
</style>

<form action="/Profile/update_profile" method="POST">
        <h3 style="margin-top:0">Update your profile</h3>

        <div class="row">
            <div class="field column">
                <label>Name</label>
                <input class="ctrl" name="name" type="text" value="<?= $user_data['name'];?>">
                <span class="field-msg"></span>
            </div>

            <div class="field column">
                <label>Email</label>
                <input class="ctrl" name="email" type="email" value="<?= $user_data['email'];?>">
                <span class="field-msg"></span>
            </div>
        </div>

        <div class="row">
            <div class="field column">
                <label>Mobile Phone Number</label>
                <input class="ctrl" name="telephone" type="text" value="<?= strlen($user_data['telephone'])<10? '0' . $user_data['telephone']:$user_data['telephone'] ;?>">
                <span class="field-msg"></span>
            </div>
        </div>

        <div class="row">
            <div class="field column">
                <label>Address</label>
                <input class="ctrl" name="address" type="text" value="<?= $user_data['address'];?>">
                <span class="field-msg"></span>
            </div>
        </div>

        <div><button type="submit" class="btn">Update</button></div>
</form>