<?php require __DIR__ . "./../../_layout/header.php"; ?>

<style>
    .profile-links {
        display: flex;
    }

    .prof-sec-link {
        display: block;
        text-decoration: none;
        color: black;
        padding: .5em 1em;
        padding-bottom: .3em;
        cursor: pointer;
        transition: all .5s ease-in-out;
        border-bottom: .2em solid var(--gray-2);
        border-radius: 8px 8px 0 0;
    }

    .prof-sec-link:hover {
        background: var(--gray-1);
    }

    .prof-sec-link.active {
        border-color: var(--primary);
        background: var(--gray-1);
        font-weight: 500;
    }
</style>
<div class="container" style="max-width: 900px;">
    <div style="display:flex;margin: 1em;align-items:center">
        <div class="placeholder-box mr1" style=" height: 100px; width:100px; "><?php foreach($details as $key=>$value){print_r($value['logo']);} ?></div>
        <div class="flex-auto">
            <div style = "font-weight:500;font-size:1.5rem;"><?php foreach($details as $key=>$value){print_r($value['name']);} ?></div>
            <div style = "font-size:medium;"><?php foreach($details as $key=>$value){print_r($value['tagline']);} ?></div>
        </div>
        <div>
            <a class='btn green' href='/view/public/organizations/donations.php' style='margin-left :20px;'>Donate</a>
        </div>
        <div>
            <a class='btn green' href='/view/public/organizations/review_organization.php' style='margin-left :20px;'>Review</a>
        </div>
    </div>
    <div class="m2 profile-links">
        <a class="prof-sec-link <?= $active == "timeline" ? 'active' : '' ?>" href="/organization/get_org_timeline&org_id=<?=$_GET['org_id']?>">Timeline</a>
        <a class="prof-sec-link <?= $active == "adoption" ? 'active' : '' ?>" href="?tab=adoption&org_id=<?=$_GET['org_id']?>">For Adoption</a>
        <a class="prof-sec-link <?= $active == "merchandise" ? 'active' : '' ?>" href="?tab=merchandise&org_id=<?=$_GET['org_id']?>">Merchandise</a>
        <a class="prof-sec-link <?= $active == "sponsorships" ? 'active' : '' ?>" href="?tab=sponsorships&org_id=<?=$_GET['org_id']?>">Sponsorships</a>
        <a class="prof-sec-link <?= $active == "about" ? 'active' : '' ?>" href="/organization/get_org_about&org_id=<?=$_GET['org_id']?>">About</a>
    </div>

    <?="active page-". $active?>
    
    <div class="m2">
        <?php include $active . ".php"?>
    </div>
</div>