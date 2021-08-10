<?php require __DIR__ . "./../../_layout/header.php"; ?>

<!--removed arrow keys for amount-->
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .row{
        display:flex;
    }

    .column{
        flex:50%;
    }
</style>

<div class='container px2'>
    <div class='placeholder-box mr1' style='height:50px; width:100px;'>Logo</div>
    <h2 class='mt1 txt-clr'>Donate to Tails of Freedom</h2>

    <form>
        <div class='field'>
            <label for="amount">Amount</label>
            <input class="ctrl" type="number" name="amount" step="1.00" min="0.00" placeholder="0.00" required>
        </div>


        <div class='field'>
            <p>I would like to,</p>
            <div class = "row">
                <div class = "column"><input type="checkbox" value="yes" name="displayName">&nbsp Display my name:</div>
                <div class = "column">Hiruni Dahanayake</div>
    
            </div>

            <?php /*Fetch name of adopter and display*/ ?>

        </div>

        <div class='field'>
            <div class = "row">
                <div class = "column"><input type="checkbox" value="yes" name="sendReceipt">&nbsp Receive an emailed receipt:</div>
                <div class = "column">hiruni@gmail.com</div>
            </div>

            <?php /*Fetch email of adopter and display*/ ?>

        </div>

        <p style="color:#ff0000; font-size:15px;">*If your personal details are incorrect, please visit your profile and update them</p>

        <p>If you subscribe, the first donation will be made immediately, and monthly thereafter</p>
        <button class='btn mr2' type='reset'>Clear all</button>
        <button class='btn mr2'>Donate</button>
    </form>

</div>