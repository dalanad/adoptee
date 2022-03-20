<?php require __DIR__ . "/../../../_layout/layout.php"; ?>
<div class='container px2'>
    <div style="display: flex;align-items:center;margin-top:1rem">
        <div>
            <a href="/OrgManagement/reports_list" class="btn btn-link btn-icon mr1 " style="font-size: 1em;">
                <i class="fa fa-arrow-left"></i></a>
        </div>
        <h2 style="margin:0">Rescue Information Report</h2>
    </div>
    <table class="table">
        <tr>
            <th>ANIMAL ID</th>
            <th>NAME</th>
            <th>TYPE</th>
            <th>AGE</th>
            <th>REPORTED TIME</th>
            <th>ACCEPTED TIME</th>
            <th>RESCUED TIME</th>
            <th>REPORTED TO ACCEPTED</th>
            <th>ACCEPTED TO RESCUED</th>
            <th>TOTAL TIME TAKEN</th>
        </tr>
        <?php foreach ($rescues_information as $data) { ?>
            <tr>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
                <td><?= $data["description"] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>