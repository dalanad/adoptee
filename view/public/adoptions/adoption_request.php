<?php
require_once  dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
// include "conn.php";
?>
<style>
    .report {
        display: grid;
        margin: 0rem 1rem 3rem 1rem;
    }
    
    @media (min-width:780px) {
        .report {
            grid-template-columns: 1fr 1fr;
            column-gap: 1rem;
            margin: 2rem;
        }

        #image {
            grid-column: 1;
            grid-row: 1 / span 10;
            height: 100%;
        }
    }

    @media (min-width:1200px) {
        .ctx {
            height: calc(100% - 150px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    }
</style>

<div class="container ctx">
    <div class = "report">

        <div class='field'>
            <label>Name of adopter</label>
            <?php  
                /*Fetch name of adopter and display*/
            ?>
            <input class="ctrl" readonly name="name" value="Hiruni Dahanayake" required />
            <span class="field-msg"> </span>
        </div>

        <div class='field'>
            <label>Contact number</label>
            <?php  
                /*Fetch contact number of adopter and display*/
            ?>
            <input class="ctrl" readonly name="num" value="071 1234 123" required />
            <span class="field-msg"> </span>
        </div>

        <!-- temporary image -->
        <div class="rounded"   id = "image"><img    style="border-radius:8px;max-height: 450px;margin:0 auto" src = "/assets/images/dogs/placeholder0.jpg"/></div>

        <div class='field'>
            <label>Email</label>
            <?php  
                /*Fetch email address of adopter and display*/
            ?>
            <input class="ctrl" readonly name="email" value="hiruni@gmail.com" required />
            <span class="field-msg"> </span>
        </div>

        <p style = "color:#ff0000; font-size:15px;">*If your personal details are incorrect, please visit your profile and update them</p>

        <div class='field'>
            <div>
                <label for = "has_pets">Do you own any pets? &nbsp&nbsp&nbsp</label>
                Yes <input class ="ctrl-check" type = "radio" value = "yes" name = "has_pets"/>
                No <input class ="ctrl-check" type = "radio" value = "no" name = "has_pets"/>
                <span class="field-msg"> </span>
            </div>
        </div>

        <div class='field'>
            <div>
                <label for = "children">Are there children living in the same household? &nbsp&nbsp&nbsp</label>
                Yes <input class ="ctrl-check" type = "radio" value = "yes" name = "children"/>
                No <input class ="ctrl-check" type = "radio" value = "no" name = "children"/>
                <span class="field-msg"> </span>
            </div>
        </div>

    </br>
    
        <div><button class='btn mr2'>Send request</button></div>

    </div>
</div>