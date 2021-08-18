<?php require_once __DIR__ . "./../../_layout/layout.php" ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">

<style>
    .row{
        display:flex;
    }

    .column{
        margin-right:1rem;
        flex:50%;
    }
</style>

<form class="centered-container" action = "/Profile/update" method = "POST">
<div class="card-container">
<div>

    <div class = "title-text">
        <label style = "font-size:1.1rem;">Update your profile</label>
    </div>

    <div class = "row">
        <div class = "field column">
            <label>Name</label>
            <input class = "ctrl" name = "name" type = "text">
            <span class = "field-msg"></span>
        </div>
        
        <div class = "field column">
            <label>Email</label>
            <input class = "ctrl" name = "email" type = "email">
            <span class = "field-msg"></span>
        </div>
    </div>

    <div class = "row">
        <div class = "field column">
            <label>Telephone</label>
            <input class = "ctrl" name = "telephone" type = "text">
            <span class = "field-msg"></span>
        </div>
    </div>

    <div class = "row">
        <div class = "field column">
            <label>Address</label>
            <input class = "ctrl" class = "address" type = "text">
            <span class = "field-msg"></span>
        </div>
    </div>

    <div><button class = "btn">Update</button></div>
    
    <div class = "mt2" style = "font-size:0.8rem;">
        <a class = "btn-link bold text-decoration-none" href = "./user_profile.php">Back</a>
    </div>
</div>
</div>
</form>