<?php require_once __DIR__ . "./../../_layout/layout.php" ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">

<div class="centered-container">
<div class="card-container">
<div class="animated-card" id="sign-up">
<div>

    <div class = "m2" id = "image" style="text-align:center;">
        <img style="border-radius:8px; height:50px;" 
        src="/assets/images/logo.png" />
    </div>

    <div class = "title-text center">
    <label style = "font-size:1.1rem;">Change Password</label>
    </div>

    <div class = "field">
        <label>Current Password</label>
        <input class = "ctrl" type = "password">
        <span class = "field-msg"></span>
    </div>

    <div class = "field">
        <label>New Password</label>
        <input class = "ctrl" type = "password">
        <span class = "field-msg"></span>
    </div>

    <div class = "field">
        <label>Confirm Password</label>
        <input class = "ctrl" type = "password">
        <span class = "field-msg"></span>
    </div>

    <div class = "field center mt1"><button class = "btn">Change Pasword</btn></div>

    <div class = "center mt2" style = "font-size:0.8rem;">
        <a class = "btn-link bold text-decoration-none" href = "./user_profile.php">Back</a>
    </div>

</div>
</div>
</div>
</div>