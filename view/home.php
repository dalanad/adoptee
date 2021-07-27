<?php
require_once __DIR__ .  './_layout/layout.php';
require __DIR__ . "./_layout/header.php";
?>
<style>
    .landing-image-container {
        width: 100%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .landing-image-container img {
        min-width: 900px;
        max-width: 1150px;
    }

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
        max-height: 150px;
        margin: 1rem 0
    }
</style>
<div class="landing-image-container"> <img src="/assets/images/pets-lineup.jpg" /></div>
<div class="container" style="max-width: 1500px;">
    <main style="margin: 1em;display:flex;justify-content:space-around;flex-wrap:wrap;">
        <div class="activity-card">
            <img src="/assets/images/graphics/pet_taged.png">
            Help us give them a family by Bringing one Home
            <a class="btn green" href="/view/adoption_listing.php">Adopt a Pet</a>
        </div>
        <div class="activity-card">
            <img src="/assets/images/graphics/takecare.png">
            Let us know about The animals that, need help
            <a class="btn orange flex-column" href="/view/report_rescue.php">
                <div> Report</div>
                <div style="line-height:1;font-size:.75em"> Injured / Abandoned Animals </div>
            </a>
        </div>
        <div class="activity-card">
            <img src="/assets/images/graphics/shelter.png">
            Support Organizations that give Life to helpless Souls
            <a class="btn blue" href="/view/organization_listing.php">Donate or Sponsor</a>
        </div>
        <div class="activity-card">
            <img src="/assets/images/graphics/vet.png">
            Veterinary Consultations at Your Fingertips
            <a class="btn pink" href="/view/doctor_consultation.php">Consult Doctor</a>
        </div>
    </main>
</div>