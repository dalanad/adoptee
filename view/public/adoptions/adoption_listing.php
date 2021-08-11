<?php

require __DIR__ . "./../../_layout/header.php";

$dog_names = array(
    'Toby', 'Zeus', 'Ellie', 'Nala',  'Bella', 'Charlie',
    'Luna', 'Lucy',
    'Max', 'Bailey',
    'Cooper', 'Daisy',
    'Sadie', 'Molly', 'Buddy', 'Lola', 'Stella', 'Tucker', 'Bentley', 'Zoey', 'Harley', 'Maggie', 'Riley', 'Bear', 'Sophie', 'Duke', 'Jax', 'Oliver', 'Chloe', 'Jack',

);  ?>
<style>
    .adoption-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(185px, 1fr));
        gap: 1rem;
    }

    .adoption-card {
        border-radius: 8px;
        background: #fafafa;
        transition: background-color .5s ease-out;
        cursor: pointer;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .adoption-card-details {
        display: flex;
        border-radius: 8px;
        justify-content: space-between;
    }

    .adoption-card-action {
        display: none;
        text-align: center;
        min-height: 2em;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 2px;
        color: white;
        font-size: 1.4em;
        height: 2.9rem;
    }

    .adoption-card:hover {
        background: var(--green);
    }

    .adoption-card:hover .adoption-card-action {
        display: flex;
    }

    .adoption-card:hover .adoption-card-details {
        display: none;
    }
</style>

<div class="container">
    <div class="mx2 mt2 flex items-center justify-between">
        <h2 class="m0">Adopt Pets</h2>
        <div>
           <input class="ctrl" placeholder="Search"/>
        </div>
    </div>
    <div class="m2 adoption-grid">
        <?php
        foreach ($dog_names as $key => $value) {
        ?>
            <div class="adoption-card" onclick="location.href='/view/public/adoptions/adoption_request.php'">
                <div style="background-image: url('/assets/images/dogs/placeholder<?=$key%3?>.jpg');background-size: cover;height: 160px;""></div>
                <div class=" adoption-card-details">
                    <div class="p1 px2">
                        <div style="font-weight: 500;"><?= $value ?></div>
                        <div style="font-size:small"><?= rand(1, 15) ?> years</div>
                    </div>
                    <div style="font-size: 1.3em; display: flex;    align-items: center;    padding: 0 0.7em;">
                        <?= rand(1, 5) > 3 ? '<i class="txt-clr blue fa fa-mars"></i>' : '<i class="txt-clr pink fa fa-venus"></i>' ?>
                    </div>
                </div>
                <div class="adoption-card-action">ADOPT</div>
            </div>
        <?php } ?>
    </div>
</div>