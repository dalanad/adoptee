<?php
require_once __DIR__ .  './_layout/layout.php';
require __DIR__ . "./_layout/header.php";
?>
<div class='container px2'>
<div class='placeholder-box mr1' style='height:50px; width:100px;'>Logo</div>
    <h2 class='mt1 txt-clr'>Organization Dashboard</h2>
</div>
<br>
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
    <main style="margin: 1em;display:flex;justify-content:space-around;flex-wrap:wrap;">
        <div class="activity-card">
            <img src="/assets/images/paw.jpg">
            <button class="btn mr2">Animals for adoption</button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/request.png">
            <button class="btn mr2">Adoption Requests</button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/report.png">
            <button class="btn mr2">Reported Cases</button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/store.png">
            <button class="btn mr2">Store</button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/event.png">
            <button class="btn mr2">News and Events</button>
        </div>
        <div class="activity-card">
            <img src="/assets/images/review.png">
            <button class="btn mr2">Client Reviews</button>
        </div>
    </main>
</div>