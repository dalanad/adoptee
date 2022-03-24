<?php require __DIR__ . "/../../../_layout/layout.php"; ?>

<style>
    table,
    td,
    th {
        border: 0.1rem solid var(--muted);
        border-radius: 0.4rem;
        border-collapse: collapse;
    }

    .table th {
        padding: .5rem;
        text-align: center;
    }
</style>

<div class='container px2'>

    <a class="btn btn-faded black" href="/OrgManagement/reports_list" style="margin: .5rem 0rem; "><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
    <h2 style="margin:0">Rescue Information Report</h2>
    <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
        <span style="flex: 1 1 0"></span>
        <button class="btn outline pink" onclick="window.print()"><i class="fa fa-print"></i>&nbsp; Print</button>
    </form>
    <br>
    <table class="table">
        <tr>
            <th rowspan="2">REPORT ID</th>
            <th rowspan="2">ANIMAL TYPE</th>
            <th colspan="3">TIME</th>
            <th colspan="3">DURATION</th>
        </tr>
        <tr>
            <th>REPORTED </th>
            <th>ACCEPTED TIME</th>
            <th>RESCUED TIME</th>
            <th>REPORTED TO ACCEPTED</th>
            <th>ACCEPTED TO RESCUED</th>
            <th>TOTAL TIME TAKEN</th>
        </tr>
        <?php foreach ($rescues_information as $data) { ?>
            <tr>
                <td><?= $data["report_id"] ?></td>
                <td><?= $data["type"] ?> </td>
                <td><?= date('Y-m-d h:i A', strtotime($data["time_reported"])) ?></td>
                <td><?= date('Y-m-d h:i A', strtotime($data["accepted_date"])) ?></td>
                <td><?= date('Y-m-d h:i A', strtotime($data["rescued_date"])) ?></td>
                <td><?= $data["reported_to_accepted"] ?>&nbsp; Hours</td>
                <td><?= $data["accepted_to_rescued"] ?>&nbsp; Hours</td>
                <td><?= $data["total_time"] ?>&nbsp; Hours</td>
            </tr>
        <?php } ?>
    </table>
</div>