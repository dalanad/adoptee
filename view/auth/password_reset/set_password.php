<?php require_once __DIR__ . "./../../_layout/layout.php" ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">

<div class="centered-container">
    <div class="card-container">
        <div class="animated-card" id="sign-up">
            <form action="/Auth/process_set_password?email=<?=$_GET["email"]?>" method="POST">

                <div class="m2" id="image" style="text-align:center;">
                    <img style="border-radius:8px; height:50px;" src="/assets/images/logo.png" />
                </div>

                <div class="title-text center">
                    <label style="font-size:1.1rem;">Change Password</label>
                </div>

                <div>
                    <div class="field">
                        <label>New Password</label>
                        <input class="ctrl" type="password" name="pass1">
                        <span class="field-msg"></span>
                    </div>

                    <div class="field">
                        <label>Confirm Password</label>
                        <input class="ctrl" type="password" name="pass2">
                        <span class="field-msg"></span>
                    </div>
                </div>

                <div class="field center mt1"><button class="btn">Change Pasword</btn>
                </div>

            </form>
        </div>
    </div>
</div>