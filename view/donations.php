<?php
require_once  dirname(__FILE__) .'./_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
// include "conn.php"
?>

<div class = 'container'>
    <form>
        <!-- <div class = 'field'>

            <select name = 'orgs' required>-->

                <!-- fetch org names from db and display in dropdown -->
                <?php
                    /*$orgs = mysqli_query($db, "SELECT name FROM Organization")
                    while($data = mysqli_fetch_assoc($orgs)){
                    echo "<option value = '" . $data['name'] . "'>" . $data['name'] . "</option>"
                    }*/
                ?>
                <!-- <option selected = 'true' disabled = 'disabled'>Select Organization</option>
                <option value = 'tails of freedom'>Tails of Freedom</option>
                <option value = 'cat protection trust'>Cat Protection Trust</option>
            </select>
        </div> -->

        <div class = 'field'>

            <select name = 'amount' required>

                <?php
                    /*$amt = mysqli_query($db, "SELECT amount FROM Organization WHERE name = 'org'")
                    while($data = mysqli_fetch_assoc($amt)){
                    echo "<option value = '" . $data['amt'] . "'>" . $data['amt'] . "</option>"
                }*/
                ?>

                <option selected = 'true' disabled = 'disabled'>Amount</option>
                <option value = '5000'>Rs. 5000</option>
                <option value = '10000'>Rs. 10000</option>
                <option value = '15000'>Rs. 15000</option>
            </select>
        </div>

        <div class = 'field'>

            <label for = 'name'>Name to be displayed (optional)</label>

            <?php
                /*select user's email as $data
                echo "<input type = "text" placeholder = '" .$data['email'] ."'/>"*/
            ?>

            <input type = "text" name = "name" placeholder = "Hiruni"/>

        </div>

        <div class = 'field'>

            <label for = 'email'>Email</label>

            <?php
                /*select user's email as $data
                echo "<input type = "text" value = '" .$data['email'] ."'/>"*/
            ?>

            <input type = "text" name = "email" value = "hiruni@gmail.com" required/>

        </div>

        <p>If you subscribe, the first donation will be made immediately, and monthly thereafter</p>
        <a class = 'btn' href = '' style = "margin-right:20px;" type = 'reset'>Clear all</a>
        <a class = 'btn' href = '' style = "margin-right:20px;">Donate</a>
        <a class = 'btn' href = ''>Subscribe</a>

    </form>
</div>
