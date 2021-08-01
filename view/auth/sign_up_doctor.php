<?php require_once  dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
?>

<style>
    .bg-primary {
        background-color: var(--primary);
    }

    .center {
        text-align: center;
        color: var(--color);
        font-size: 30px;
    }

    .main {
        width: 500px;
        margin: auto;
    }
</style>

<div class="center">

    <p><b>Register As A Doctor </b></p>
</div>

<div class="main">
    <div class="field">

        <label for="fname"><b>First Name</b></label>
        <input class="ctrl" type="text" placeholder="Enter First Name" name="fname" id="fname" required>
    </div>

    <div class="field">
        <label for="lname"><b>Last Name</b></label>
        <input class="ctrl" type="text" placeholder="Enter Last Name" name="lname" id="lname" required>
    </div>

    <div class="field">
        <label for="regno"><b>Registration Number</b></label>
        <input class="ctrl" type="text" placeholder="Enter Registration Number" name="regno" id="regno" required>
    </div>

    <div class="field">
        <label for="teleno"><b>Contact Number</b></label>
        <input class="ctrl" type="number" placeholder="Enter Contact Number " name="teleno" id="teleno" required>
    </div>

    <div class="field"><b>Adress</b></label>
        <input class="ctrl" type="text" placeholder="Enter Adress " name="adress" id="adress" required>
    </div>

    <div class="btn">
        <button type="submit" class="btn">Register</button><br>
    </div>