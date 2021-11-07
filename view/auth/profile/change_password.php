<?php require_once __DIR__ . "/../../_layout/layout.php" ?>

<form action="/auth/change_password" style="max-width: 250px;margin:0 auto" method="POST">
    <h3 style="text-align:center;margin-top:0">Change Password</h3>
    <div class="field">
        <label>Current Password</label>
        <input class="ctrl" type="password" name="current" required/>
        <span class="field-msg"></span>
    </div>

    <div class="field">
        <label>New Password</label>
        <input class="ctrl" type="password" name="new" required/>
        <span class="field-msg"></span>
    </div>

    <div class="field">
        <label>Confirm Password</label>
        <input class="ctrl" type="password" name="confirm" required/>
        <span class="field-msg"></span>
    </div>

    <div class="field center mt1"><button type="submit" class="btn">Change Password</button>
    </div>
</form>