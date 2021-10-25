<?php require __DIR__ . "/../../_layout/layout.php";
?>
<style>
    .page {
        max-width: 500px;
        margin: 0 auto;
    }

    .column {
        float: left;
        width: 40%;
        margin: .5rem;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
<form class="row page" action="/OrgSettings/process_create_user" method="POST">
    <div style="padding: 1rem 1rem;display: flex;">
        <?php if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } ?>
        <div style="flex: 1 1 0;"></div>
        <?= user_btn() ?>
    </div>
    <h3 style="margin: 1rem .5rem;">Create Organization User</h3>
    <div class="row">
        <div class="column">
            <div class="field">
                <label for="name">Name</label>
                <input class="ctrl" type="text" name="name" id="name" required>
                <span class="field-msg">Name</span>
            </div>
            <div class="field">
                <label>Password</label>
                <input class="ctrl" type="password" autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" name="password" required>
                <small class="field-hint">Include upper & lower case letters,<br> numbers and special characters </small>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label for="name">Email Address</label>
                <input class="ctrl" type="text" name="email" id="email" required>
                <span class="field-msg">Email Address</span>
            </div>
            <div class="field"> </div>
        </div>
    </div>
    <div style="margin:.5rem">
        <button class="btn" type="submit">Submit</button><br><br>
        <a class="btn btn-faded pink" href="/OrgSettings/users">Go Back</a>
    </div>
</form>