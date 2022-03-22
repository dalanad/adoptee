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
        <h2 style="margin:0">Rescue Information Report</h2>
    </div>

    <br>
    <table class="table">
        <tr>
            <th>REPORT ID</th>
            <th>TYPE</th>
            <th>REPORTED TIME</th>
            <th>ACCEPTED TIME</th>
            <th>RESCUED TIME</th>
            <th>REPORTED TO ACCEPTED</th>
            <th>ACCEPTED TO RESCUED</th>
            <th>TOTAL TIME TAKEN</th>
        </tr>
        <?php foreach ($rescues_information as $data) { ?>
            <tr>
                <td><?= $data["report_id"] ?></td>
                <td><?= $data["type"] ?></td>
                <td><?= $data["time_reported"] ?></td>
                <td><?= $data["accepted_date"] ?></td>
                <td><?= $data["rescued_date"] ?></td>
                <td><?= $data["reported_to_accepted"] ?>&nbsp; Hours</td>
                <td><?= $data["accepted_to_rescued"] ?>&nbsp; Hours</td>
                <td><?= $data["total_time"] ?>&nbsp; Hours</td>
            </tr>
        <?php } ?>
    </table>
</div>