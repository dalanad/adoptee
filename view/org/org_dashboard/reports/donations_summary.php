<?php require __DIR__ . "/../../../_layout/layout.php"; ?>
<div class='container px2'>
    <a class="btn btn-faded black" href="/OrgManagement/reports_list" style="margin: .5rem 0rem; "><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
    <h2 style="margin:0">Donations Summary Report</h2>
    <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
        <span style="flex: 1 1 0"></span>
        <button class="btn outline pink" onclick="window.print()"><i class="fa fa-print"></i>&nbsp; Print</button>
    </form>
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