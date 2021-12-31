<?php require __DIR__ . "/../../_layout/header.php"; ?>

<style>
    .logo {
        height: 6.1rem;
        width: 6.1rem;
        border-radius: 8px;
    }

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

    .fa-star {
        color: var(--gray-3);
    }

    .checked,
    .fa-star-half {
        color: orange;
    }
</style>
<div class="container" style="max-width: 900px;">
    <div style="display:flex;margin: 1em;align-items:center">
        <div class="placeholder-box mr1" style=" height: 100px; width:100px; ">
            <?php foreach ($details as $key => $value) { ?> <img class="logo" src="<?= $value['logo'] ?>"> <?php } ?>
        </div>
        <div class="flex-auto">
            <div style="font-weight:500;font-size:1.5rem;"><?php foreach ($details as $key => $value) {
                                                                print_r($value['name']);
                                                            } ?></div>
            <div style="font-size:medium;"><?php foreach ($details as $key => $value) {
                                                print_r($value['tagline']);
                                            } ?></div>
            <div style="font-size: .9rem; margin-top:.3rem; margin-bottom:1rem;">
                <?php for ($i = 0; $i < round($value['rating']); $i++) { ?>
                    <span class="fa fa-star checked"></span>
                <?php }
                if ($value['rating'] - round($value['rating']) > 0) { ?>
                    <span class="fas fa-star-half"></span>
                <?php }
                for ($i = 0; $i < 5 - ceil($value['rating']); $i++) { ?>
                    <span class="far fa-star"></span>
                <?php } ?>
            </div>
        </div>
        <div>
            <a class='btn green' href='/Organization/view_donation_page?org_id=<?= $_GET['org_id'] ?>' style='margin-left :20px;'>Donate</a>
        </div>
        <div>
            <a class='btn green' href='/Organization/view_review_page?org_id=<?= $_GET['org_id'] ?>' style='margin-left :20px;'>Review</a>
        </div>
    </div>
    <div class="m2 profile-links">
        <a class="prof-sec-link <?= $active == "timeline" ? 'active' : '' ?>" href="/organization/get_org_timeline&org_id=<?= $_GET['org_id'] ?>">Timeline</a>
        <a class="prof-sec-link <?= $active == "adoption" ? 'active' : '' ?>" href="/organization/get_org_adoption&org_id=<?= $_GET['org_id'] ?>">For Adoption</a>
        <a class="prof-sec-link <?= $active == "merchandise" ? 'active' : '' ?>" href="/organization/get_org_merchandise&org_id=<?= $_GET['org_id'] ?>">Merchandise</a>
        <a class="prof-sec-link <?= $active == "sponsorships" ? 'active' : '' ?>" href="/organization/get_org_sponsorships&org_id=<?= $_GET['org_id'] ?>">Sponsorships</a>
        <a class="prof-sec-link <?= $active == "about" ? 'active' : '' ?>" href="/organization/get_org_about&org_id=<?= $_GET['org_id'] ?>">About</a>
    </div>

    <div class="m2">
        <?php include $active . ".php" ?>
    </div>
</div>