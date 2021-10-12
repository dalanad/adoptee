<?php require __DIR__ . "/../../_layout/header.php"; ?>

<div style="text-align: center;">
    <h2 style="margin-top: 2em;color:var(--green)">Report Successfully Recorded</h2>
    <br>
    <img src="/assets/images/graphics/dog_paly.svg" style="height: 180px;" />
    <p>
        Thank you for helping us, to save a life<br>
        <small>An organization will respond to your request</small>
    </p>
    <p>You will get progress updates to your phone<b> 07****<?= substr($report["contact_number"], -4) ?></b></p>
    <br>
    <div>
        <a class="btn btn-link" href="/auth/sign_in">Sign Up</a>to view previous reports
    </div>
    <br>
    <p>
        <a class="btn btn-faded pink" href="/">Go to Home </a>
    </p>
</div>