<?php require __DIR__ . "/../../../_layout/layout.php"; ?>
<div class='container px2'>
    <div style="display: flex;align-items:center;margin-top:1rem">
        <div>
            <a href="/OrgManagement/reports_list" class="btn btn-link btn-icon mr1 " style="font-size: 1em;">
                <i class="fa fa-arrow-left"></i></a>
        </div>
        <h2 style="margin:0">Donations Summary Report</h2>
    </div>

    <table class="table">
        <tr>
            <th>DATE</th>
            <th>DONATION COUNT</th>
            <th>DONATION TOTAL</th>
            <th>NEW SUBSCRIPTIONS COUNT</th>
            <th>NEW SUBSCRIPTIONS TOTAL AMOOUNT</th>
        </tr>
        <?php foreach ($donations_summary as $data) { ?>
            <tr>
                <td><?= $data["txn_time"] ?></td>
                <td><?= $data["donation_count"] ?></td>
                <td><?= $data["donation_amount"] ?></td>
                <td><?= $data["subscription_count"] ?></td>
                <td><?= $data["subscription_amount"] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>