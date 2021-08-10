<?php require __DIR__ . "./../../_layout/header.php"; ?>
<?php $active = isset($_GET["tab"]) ? $_GET["tab"] : "timeline"; ?>
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
        <div class="placeholder-box mr1" style=" height: 100px; width:100px; ">LOGO</div>
        <div class="flex-auto">
            <div style="font-weight:500">Organization Name</div>
            <div style="font-size:small">Tagline</div>
        </div>
        <div>
            <a class='btn green' href='/view/public/organizations/donations.php' style='margin-left :20px;'>Donate</a>
        </div>
        <div>
            <a class='btn green' href='/view/public/organizations/review_organization.php' style='margin-left :20px;'>Review</a>
        </div>
    </div>
    <div class="m2 profile-links">
        <a class="prof-sec-link <?= $active == "timeline" ? 'active' : '' ?>" href="?tab=timeline">Timeline</a>
        <a class="prof-sec-link <?= $active == "adoption" ? 'active' : '' ?>" href="?tab=adoption">For Adoption</a>
        <a class="prof-sec-link <?= $active == "merchandise" ? 'active' : '' ?>" href="?tab=merchandise">Merchandise</a>
        <a class="prof-sec-link <?= $active == "sponsorships" ? 'active' : '' ?>" href="?tab=sponsorships">Sponsorships</a>
        <a class="prof-sec-link <?= $active == "about" ? 'active' : '' ?>" href="?tab=about">About</a>
    </div>
    <div class="m2"> Content</div>
</div>

<div></div>