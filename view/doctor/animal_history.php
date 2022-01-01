<?php
$active = "consulted_animals";
require_once  __DIR__ . '/_nav.php';
?>


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

    .thumbnails {
        overflow-x: auto;
        white-space: nowrap;
        margin: 0 1rem;
        max-width: 600px;
    }

    .thumbnail {
        border-radius: 8px;
        background-size: cover;
        width: 60px;
        height: 70px;
        margin: .5rem .25rem;
        display: inline-block;
        border: var(--border);
    }
</style>
<?php $active = isset($_GET["tab"]) ? $_GET["tab"] : "consultations"; ?>

<div style="padding:0 1rem">

    <button class="btn btn-faded black" style="margin-bottom: 1rem;" onclick="history.back()"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>

    <div style="display: flex; ">
        <div style="margin-bottom: .5rem;display:flex;flex:50%">
            <img style="border: var(--border); border-radius: 50%;background-size: cover;width: 50px;height: 50px;background-image: url(<?= $animal['photo'] ?>);">
            <div style="margin-left: .5rem;flex:1">
                <div>
                    <b><?= $animal['name'] ?></b> &nbsp; <i class="txt-clr fa fa-<?= $animal['gender'] == "male" ? 'mars blue' : 'venus pink' ?>"></i>
                </div>
                <div style="font-size: .8em;">
                    <?= $animal['age'] ?> Years old -
                </div>
                <div><small><?= str_replace(array('[', ']', '"'), '', $animal['color']); ?> &nbsp;- <?= strtoupper($animal['type']) ?></small></div>
            </div>
        </div>
        <div style="margin: 0 1rem;;flex:50%">
            <div><b>Owner : </b><?= $owner["name"] ?> <button class="btn btn-link black"><i class="far fa-phone"></i></button></div>
            <div> <?= $owner["email"] ?><br><?= $owner["telephone"] ?><br><?= $owner["address"] ?> </div>
        </div>
    </div>

    <div class="profile-links" style="margin-top: 1rem;">
        <a class="prof-sec-link <?= $active == "consultations" ? 'active' : '' ?>" href="?tab=consultations">Previous Consultations</a>
        <a class="prof-sec-link <?= $active == "prescriptions" ? 'active' : '' ?>" href="?tab=prescriptions">Prescriptions</a>
        <a class="prof-sec-link <?= $active == "media" ? 'active' : '' ?>" href="?tab=media">Media</a>
    </div>
</div>
<?php if ($active == "consultations") { ?>
    <table class="table">
        <tr>
            <th>Consultation Date & Time</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
        <?php foreach ($consultations as $consultation) { ?>
            <tr>
                <td><?= $consultation["consultation_date"] ?> <?= substr($consultation["consultation_time"], 0, 5) ?></td>
                <td><?= $consultation["type"] ?></td>
                <td><?= $consultation["status"] ?></td>
            </tr>
        <?php } ?>
    </table>

<?php } ?>
<?php if ($active == "prescriptions") { ?>
    <table class="table">
        <tr>
            <th>Date & Time</th>
            <th></th>
        </tr>
        <?php foreach ($prescriptions as $prescription) { ?>
            <tr>
                <td><?= $prescription["created_at"] ?> </td>
                <td><button class="btn btn-faded" onclick="viewPrescription(<?= $prescription["medical_record_id"] ?>)"><i class="fas fa-eye"></i>&nbsp; View</button></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
<?php if ($active == "media") { ?>
    <div class="thumbnails">
        <?php foreach ($media as $m) { ?>
            <div class="thumbnail" style="background-image: url(<?= $m ?>);" onclick="showOverlay('<img src=\'<?= $m ?>\' style=\'max-height:80vh;max-width:80vw\'')"> </div>
        <?php } ?>
    </div>
<?php } ?>