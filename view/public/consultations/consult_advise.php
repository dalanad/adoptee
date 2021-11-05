<?php require_once __DIR__ . "/../../_layout/header.php"; ?>
<link rel="stylesheet" href="/assets/css/doctor.css">
<script src="/assets/js/doctor.js"></script>

<div style="max-width:900px;padding:1rem;margin:0 auto;">
    <a class="btn btn-faded black" style="font-weight: 400;" href="/profile/consultations"><i class="far fa-arrow-left"></i> &nbsp; Back </a>
    <h2>Veterinary Advise </h2>
    <div class="chat-container" style="grid-template-columns: 1fr;">
        <div class="chat-window" style="min-height: 25em;"> </div>
    </div>
</div>
<script>
    initChat(<?= $consultation["consultation_id"] ?>, true)
</script>