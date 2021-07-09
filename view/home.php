<?php
require_once __DIR__ .  './_layout/layout.php';
require __DIR__ . "./_layout/header.php";
?>
<div style="width: 100%; overflow: hidden; display: flex; justify-content: center; align-items: center;">
    <img style="min-width:900px" src="/assets/images/pets-lineup.jpg">
</div>
<style>
    .activity-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 250px;
        text-align: center;
    }

    .activity-card .btn {
        min-height: 2.3em;
        padding: .0 1rem;
        margin-top: 1rem;
    }

    .activity-card img {
        max-height: 180px;
        margin: 1rem 0
    }
</style>
<div class="container">
    <!-- TODO : images are not very good. need to replace them with better matching ones-->
    <main style="margin: 1em;display:flex;justify-content:space-around;flex-wrap:wrap;">
        <div class="activity-card">
            <img src="/assets/images/need-home.jpg">
            Help us give them a family by Bringing one Home
            <button class="btn outline green">Adopt a Pet</button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/medical-equipment.jpg">
            Let us know about The animals that, need help
            <button class="btn outline orange flex-column">
                <div> Report</div>
                <div style="line-height:1;font-size:.75em"> Injured / Abandoned Animals </div>
            </button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/shelter.jpg">
            Support Organizations that give Life to helpless Souls
            <button class="btn outline blue">Donate or Sponsor</button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/doctor_holding_pet.jpg">
            Veterinary Consultations at Your Fingertips
            <button class="btn outline pink">Consult Doctor</button>
        </div>
    </main>
</div>