<?php require_once __DIR__ . "./../../_layout/layout.php" ?>



<style>
    .row {
        display: flex;
    }

    .column {
        margin-right: 1rem;
        flex: 50%;
    }
</style>

<form action="/Profile/update" method="POST">
        <h3 style="margin-top:0">Update your profile</h3>

        <div class="row">
            <div class="field column">
                <label>Name</label>
                <input class="ctrl" name="name" type="text" value="<?= $_SESSION['user']['name'];?>">
                <span class="field-msg"></span>
            </div>

            <div class="field column">
                <label>Email</label>
                <input class="ctrl" name="email" type="email" value="<?= $_SESSION['user']['email'];?>">
                <span class="field-msg"></span>
            </div>
        </div>

        <div class="row">
            <div class="field column">
                <label>Telephone</label>
                <input class="ctrl" name="telephone" type="text" value="<?= $_SESSION['user']['telephone'];?>">
                <span class="field-msg"></span>
            </div>
        </div>

        <div class="row">
            <div class="field column">
                <label>Address</label>
                <input class="ctrl" name="address" type="text" value="<?= $_SESSION['user']['address'];?>">
                <span class="field-msg"></span>
            </div>
        </div>

        <div><button class="btn">Update</button></div>
</form>