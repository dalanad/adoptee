<?php require __DIR__ . "/../../../_layout/layout.php"; ?>

<style>
    table,
    td,
    th {
        border: 0.1rem solid var(--muted);
        border-radius: 0.4rem;
        border-collapse: collapse;
    }
</style>

<div class='container px2'>
    <div style="display: flex;align-items:center;margin-top:1rem">
        <div>
            <a href="/OrgManagement/reports_list" class="btn btn-link btn-icon mr1 " style="font-size: 1em;">
                <i class="fa fa-arrow-left"></i></a>
        </div>
        <h2 style="margin:0">Rescue to Adoption Report</h2>

    </div>

    <table class="table">
        <tr>
            <th>ANIMAL ID</th>
            <th>NAME</th>
            <th>TYPE</th>
            <th>AGE</th>
            <th>DATE RESCUED </th>
            <th>DATE LISTED</th>
            <th>DATE ADOPTED</th>
            <th>RESCUED TO LISTED</th>
            <th>LISTED TO ADOPTED</th>
            <th>RESCUED TO ADOPTED</th>
        </tr>
        <?php foreach ($rescue_to_adoption as $data) { ?>
            <tr>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_id"] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>