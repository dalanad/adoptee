<?php
require_once __DIR__ .  './_layout/layout.php';
require __DIR__ . "./_layout/header.php";
?>
<div style="width: 100%; overflow: hidden; display: flex;   justify-content: center; align-items: center;">
    <img style="min-width:900px" src="/assets/images/pets-lineup.jpg">
</div>
<div class="container">
    <main style="margin: 1em;display:flex;justify-content:space-around;flex-wrap:wrap;">
        <div style="display:flex;flex-direction:column;align-items:center">
            <img style="max-height: 180px;margin:1rem 0" src="/assets/images/need-home.jpg">
            <button class="btn">Adopt</button>
        </div>
        <div style="display:flex;flex-direction:column;align-items:center">
            <img style="max-height: 180px;margin:1rem 0" src="/assets/images/medical-equipment.jpg">
            <button class="btn orange">Report</button>
        </div>
        <div style="display:flex;flex-direction:column;align-items:center">
            <img style="max-height: 180px;margin:1rem 0" src="/assets/images/shelter.jpg">
            <button class="btn green">Donate</button>
        </div>
        <div style="display:flex;flex-direction:column;align-items:center">
            <img style="max-height: 180px;margin:1rem 0" src="/assets/images/doctor_holding_pet.jpg">
            <button class="btn pink">Consult</button>
        </div>
    </main>
    <footer></footer>
</div>