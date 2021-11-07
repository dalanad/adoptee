<div style="font-size: 1.1rem;"><i class="far fa-calendar-check"></i> &nbsp; <b> Complete Consultation </b></div>
<?php
$return_url = $consultation["type"] == "ADVISE" ? "/doctor/medical_advise/" : "/doctor/live_consultation";
$is_user = $_SESSION["user"]["user_id"] == $consultation["user"]["user_id"];
if ($is_user) {
    $return_url = "/profile/consultations";
}
?>
<form action="/api/complete_consultation" method="POST">
    <div style="margin: 1rem 0;line-height:1.3">
        <div style="white-space: nowrap;">Consultation Type : <?= strtoupper($consultation["type"]) ?></div>
        <?php if ($is_user) { ?>
            <div style="white-space: nowrap;">Doctor : <?= $consultation["doctor"]["name"] ?></div>
            <div style="display: flex; align-items:center;">
                <label for="rating">Your Rating :</label>
                &nbsp;
                <input type="range" min="1" max="5" step="1" name="rating" id="rating" onchange="rate.innerHTML=this.value+'/5'">
                &nbsp; <span id="rate">3/5</span>
            </div>
        <?php } else { ?>
            <div style="white-space: nowrap;">Owner : <?= $consultation["user"]["name"] ?></div>
            <div style="white-space: nowrap;">Animal : <?= $consultation["animal"]["name"] ?></div>
        <?php }  ?>
    </div>
    <div>
        <small> <i class="far fa-info-circle"></i>&nbsp; You can access the chat again through consultation history</small>
    </div>
    <input type="hidden" name="return_url" value="<?= $return_url ?>">
    <input type="hidden" name="consultation_id" value="<?= $consultation["consultation_id"] ?>">
    <div style="margin-top: 2rem;display:flex;justify-content:space-between">
        <a class="btn red btn-link" href="#">Cancel</a>
        <button class="btn green">Complete</button>
    </div>
</form>