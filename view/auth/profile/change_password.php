<?php require_once __DIR__ . "/../../_layout/layout.php" ?>

<form action="/auth/change_password" style="max-width: 250px;margin:0 auto" method="POST">
    <h3 style="text-align:center;margin-top:0">Change Password</h3>
    <div class="field">
        <label>Current Password</label>
        <input class="ctrl" type="password" name="current" required />
        <span class="field-msg"></span>
    </div>

    <div class="field">
        <label>New Password</label>
        <input class="ctrl" type="password" name="new" autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" required />
        <small class="field-hint">Include upper & lower case letters,<br> numbers and special characters </small>
    </div>

    <div class="field">
        <label>Confirm Password</label>
        <input class="ctrl" type="password" name="confirm" required />
        <span class="field-msg"></span>
    </div>

    <?php if (isset($_GET["error"])) { ?>
        <div style="color: red; font-weight:bold;text-align: center;margin-top: 1rem; ">
            <?php if ($_GET["error"] == "wrongpassword") { ?>
                Wrong Password
            <?php } elseif ($_GET["error"] == "nomatch") { ?>
                Passwords do not match
            <?php } ?>
        </div></br>
    <?php } elseif (isset($_GET["successful"])) { ?>
        <div style="color: var(--green); font-weight:bold;font-weight: bold;text-align: center;margin-top: 1rem; ">
            Password was changed successfully
        </div></br>
    <?php } ?>

    <div class="field center mt1"><button type="submit" class="btn">Change Password</button>
    </div>
</form>