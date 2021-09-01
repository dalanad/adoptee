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

    /* .tier-card .btn {
         opacity: .2;
         transition: opacity .2s ease-in-out;
     }

     .tier-card:hover .btn {
         opacity: 1;
     } */

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
</style>

<div class="container">

    <?php
    foreach ($orgs as $key => $value) { ?>
    
        <div class="tier-card">
            <div class="title"><?php print_r($value['name']); ?></div>
            <div class="subtitle"><?php print_r($value['tagline']); ?></div>
            <div class="logo"><?php print_r($value['logo']); ?></div>
            <!-- <a class="btn" href="view_profile">View Profile</a> -->
            <a class="btn" href="get_org_timeline?org_id=<?php echo($value['org_id']) ?>">View Profile</a>
    </div>
    <?php } ?>

</div>