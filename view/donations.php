<?php
require_once dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
// include "conn.php";
?>

<div class='container px2'>
    <div class='placeholder-box mr1' style='height:50px; width:100px;'>Logo</div>
    <h2 class='mt1 txt-clr'>Donate to Tails of Freedom</h2>
    
    <form>
        <div class='field'>
            <label for = "amount">Amount</label>
            <input class = "ctrl" type="number" name = "amount" step="10.00" min = "0.00" 
            placeholder = "0.00" required>
        </div>

        <div class='field'>
            <label for='name'>Name to be displayed (optional)</label>
            <input class="ctrl" type="text" name="name" placeholder="Hiruni" />
        </div>

        <div class='field'>
            <label for='email'>Email</label>
            <input class="ctrl" readonly name="email" value="hiruni@gmail.com" required />
        </div>

        <p>If you subscribe, the first donation will be made immediately, and monthly thereafter</p>
        <button class='btn mr2' type='reset'>Clear all</button>
        <button class='btn mr2'>Donate</button>
    </form>

</div>