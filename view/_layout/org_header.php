<?php require_once  __DIR__ . './layout.php' ?>
<div>
    <header class="header">
        <a class="logo">
            <img src="/assets/images/logo_vector.svg" />
        </a>

        <!-- add heading -->

        <?php if ($data["header"]["nav"] == true) { ?>
            <nav class="main-nav">
                <div class="flex justify-between" style="width:100%">
                    <button class="btn btn-link more-btn" onclick="document.querySelector('.main-nav').classList.toggle('shown')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <a class="link" href="/view/public/home.php">Home</a>
                <a class="link" href="/view/public/adoptions/adoption_listing.php">Adoptions</a>
                <a class="link" href="/view/public/rescues/report_rescue.php">Rescues</a>
                <a class="link" href="/view/public/organizations/organization_listing.php">Organizations</a>
                <a class="link" href="/view/public/consultations/doctor_consultation.php">Veterinary Consultations</a>
            </nav>
        <?php } ?>

        <?= user_btn() ?>

        <?php if ($data["header"]["nav"] == true) { ?>
            <button class="btn btn-link more-btn black" onclick="document.querySelector('.main-nav').classList.toggle('shown')">
                <i class="fa fa-bars"></i>
            </button>
        <?php } ?>

    </header>
</div>