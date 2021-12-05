<?php require_once  __DIR__ . '/layout.php' ?>
<div class="container">
    <header class="header">
        <a class="logo" href="/">
            <img src="/assets/images/logo_vector_filled.svg" alt="Adoptee Logo" />
        </a>
        <nav class="main-nav">
            <div class="flex justify-between" style="width:100%">
                <button class="btn btn-link more-btn" onclick="document.querySelector('.main-nav').classList.toggle('shown')">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <a class="link" href="/Adoptions">Adoptions</a>
            <a class="link" href="/ReportRescues/view">Rescues</a>
            <a class="link" href="/Organization/get_org_listing">Organizations</a>
            <a class="link" href="/Consultation">Veterinary Consultations</a>
        </nav>
        <?= notif_btn() ?>
        <?= cart_btn() ?>
        <?= user_btn() ?>
        <button class="btn btn-link more-btn black" onclick="document.querySelector('.main-nav').classList.toggle('shown')">
            <i class="fa fa-bars"></i>
        </button>
    </header>
</div>