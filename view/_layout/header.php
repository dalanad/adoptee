<?php require_once  __DIR__ . './layout.php' ?>
<div class="container">
    <header class="header">
        <a class="logo">
            <img src="/assets/images/logo_vector.svg" />
        </a>

        <?php if ($data["header"]["nav"] == true) { ?>
            <nav class="main-nav">
                <div class="flex justify-between" style="width:100%">
                    <button class="btn btn-link more-btn" onclick="document.querySelector('.main-nav').classList.toggle('shown')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <a class="link" href="/view/home.php">Home</a>
                <a class="link" href="/view/adoption_listing.php">Adoptions</a>
                <a class="link" href="/view/report_rescue.php">Rescues</a>
                <a class="link" href="/view/organization_listing.php">Organizations</a>
                <a class="link" href="/view/doctor_consultation.php">Veterinary Consultations</a>
            </nav>
        <?php } ?>

        <?php if (isset($data["user"])) { ?>
            <a class="btn btn-link" style="font-size:1rem" href="/view/signin.php"><i class="fa fa-user"> </i> &nbsp; Dalana </a>
        <?php } else { ?>
            <a class="btn green" href="/view/signin.php">Sign In</a>
        <?php } ?>

        <?php if ($data["header"]["nav"] == true) { ?>
            <button class="btn btn-link more-btn black" onclick="document.querySelector('.main-nav').classList.toggle('shown')">
                <i class="fa fa-bars"></i>
            </button>
        <?php } ?>

    </header>
</div>