<?php require_once __DIR__ .  './../../_layout/header.php'; ?>

<style>
    .tier-card {
        text-align: center;
        padding: 1rem;
        border: 3px solid var(--gray-3);
        border-radius: 8px;
        cursor: pointer;
        display: inline-block;
        width: 13rem;
    }

    .tier-card:hover {
        transition: border-color .2s ease-in-out;
        border-color: var(--primary);
    }

    .tier-card .logo {
        font-size: 2em;
        margin-bottom: 0.8rem;
    }

    .tier-card .title {
        font-size: 1.2rem;
        font-weight: 500;
        line-height: 1em;
        margin-bottom: 1rem;
    }

    .tier-card .subtitle {
        font-size: 1rem;
        font-weight: 300;
        margin: 0.6rem;
    }

    img {
        max-width: 11rem;
        max-height: 11rem;
        border-radius: 8px;
        ;
    }

    .fa-star {
        color: var(--gray-3);
    }

    .checked{
        color:orange;
    }
</style>

<div class="container" style="text-align:center;">

    <?php
    foreach ($orgs as $key => $value) { ?>

        <div class="tier-card">
            <div class="title"><?= ($value['name']); ?></div>
            <div class="subtitle"><?= ($value['tagline']); ?></div>
            <div class="logo"><img src=<?= ($value['logo']); ?>></div>
            <div style="font-size: .9rem; margin-top:.3rem; margin-bottom:1rem;">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="far fa-star"></span>
                <span class="far fa-star"></span>
            </div>
            <a class="btn" href="get_org_timeline?org_id=<?php echo ($value['org_id']) ?>">View Profile</a>
        </div>
    <?php } ?>

</div>