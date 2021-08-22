<?php require_once  __DIR__ . './layout.php' ?>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        min-width: 80%;
        padding: 1rem 1rem;
        border: var(--border);
        border-radius: .6rem;
        overflow: auto;
        background-color: var(--gray-1);
        box-shadow: var(--shadow-heavy);
        opacity:95%;
        
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        padding: 12px 16px;
        display: block;
        text-decoration: none;
    }
</style>
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
                <a class="link" href="/view/public/home.php">Home</a>
                <a class="link" href="/view/public/adoptions/adoption_listing.php">Adoptions</a>
                <a class="link" href="/view/public/rescues/report_rescue.php">Rescues</a>
                <a class="link" href="/view/public/organizations/organization_listing.php">Organizations</a>
                <a class="link" href="/view/public/consultations/doctor_consultation.php">Veterinary Consultations</a>
            </nav>
        <?php } ?>
        <?php if (isset($_SESSION['user'])) { ?>
            <div class="dropdown btn-link " style="font-size:1rem">
                <!-- btn  -->
                <i class="fa fa-user"> </i>
                &nbsp; <?= $_SESSION['user']["name"] ?>
                <div class="dropdown-content">
                    <a class="btn-link" href="/view/auth/profile/user_profile.php">
                        <i class="fa fa-user"></i>&nbsp Profile</a>
                    <a class="btn-link">
                        <i class="fa fa-question"></i>&nbsp Help</a>
                    <a class="btn-link" href="/auth/sign_out">
                    <i class="fa fa-sign-out"></i>&nbsp Sign Out</a>
                </div>
            </div>
        <?php } else { ?>
            <a class="btn green" href="/auth/sign_in">Sign In</a>
        <?php } ?>

        <?php if ($data["header"]["nav"] == true) { ?>
            <button class="btn btn-link more-btn black" onclick="document.querySelector('.main-nav').classList.toggle('shown')">
                <i class="fa fa-bars"></i>
            </button>
        <?php } ?>

    </header>
</div>