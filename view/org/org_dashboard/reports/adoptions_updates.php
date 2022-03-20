<?php require __DIR__ . "/../../../_layout/layout.php"; ?>
<div class='container px2'>
    <div style="display: flex;align-items:center;margin-top:1rem">
        <div>
            <a href="/OrgManagement/reports_list" class="btn btn-link btn-icon mr1 " style="font-size: 1em;">
                <i class="fa fa-arrow-left"></i></a>
        </div>
        <h2 style="margin:0">Adoption Updates Report</h2>

    </div>

    <table class="table">
        <tr>
            <th>ANIMAL ID</th>
            <th>NAME</th>
            <th>TYPE</th>
            <th>AGE</th>
            <th>DATE ADOPTED</th>
            <th>ADOPTER NAME </th>
            <th>ADOPTEER CONTACT NO</th>
            <th>NO OF UPDATES </th>
            <th>LAST UPDATED</th>
        </tr>
        <?php foreach ($adoptions_updates as $data) { ?>
            <tr>
                <td><?= $data["animal_id"] ?></td>
                <td><?= $data["animal_name"] ?></td>
                <td><?= $data["type"] ?></td>
                <td><?= $data["age"] ?></td>
                <td><?= $data["date_adopted"] ?></td>
                <td><?= $data["adopter"] ?></td>
                <td><?= $data["adopter_contact"] ?></td>
                <td><?= $data["update_count"] ?></td>
                <td><?= $data["last_updated"] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>