<?php
require_once  dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
// include "conn.php";
?>

<div class='container px2'>
<div class='placeholder-box p1'>Picture</div>
<div>
    <form>

    <div class='field'>
        <label>Name of adopter</label>
        <?php  
            /*Fetch name of adopter and display*/
        ?>
        <input class="ctrl" readonly name="name" value="Hiruni Dahanayake" required />
    </div>

    <div class='field'>
        <label>Contact number</label>
        <?php  
            /*Fetch contact number of adopter and display*/
        ?>
        <input class="ctrl" readonly name="num" value="071 1234 123" required />
    </div>

    <div class='field'>
        <label>Email</label>
        <?php  
            /*Fetch email address of adopter and display*/
        ?>
        <input class="ctrl" readonly name="email" value="hiruni@gmail.com" required />
    </div>

    <p>If your personal details are incorrect, please visit your profile and update them</p>

    <div class='field'>
        <label for = "has_pets">Do you own any pets?</label>
        Yes <input class ="" type = "radio" value = "yes" name = "has_pets"/>
        No <input class ="" type = "radio" value = "no" name = "has_pets"/>
    </div>
    
    <div>
    <button class='btn mr2'>Send request</button>
</div>

    </form>
</div>