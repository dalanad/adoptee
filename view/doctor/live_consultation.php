<?php
$active = "live_consultation";
require_once  __DIR__ . '/_nav.php';
?>

<div style="display: grid;grid-template-columns:auto 250px;grid-gap:1rem">
    <div><i class="fa fa-calendar-alt"></i></div>
    <div class="timeline-container" style="grid-column: 1;">
        <div id="appointments-timeline"> </div>
    </div>

    <div>
        <div class="calender" style="box-shadow:var(--shadow);padding:1rem;border-radius:.4rem"> </div>
    </div>
    <div></div>
</div>
<script src="/assets/js/live-consultations.js"></script>