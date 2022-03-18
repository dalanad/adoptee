<style>
    th {
        font-weight: bold;
    }
</style>

<div class="overflow-auto" style="height:450px">
    <h3 style="margin:0;margin-left:1rem;">My Payments</h3>
    <table class="table">
        <tr>
            <th>TXN ID & DATE</th>
            <th>REASON</th>
            <th>STATUS</th>
            <th>AMOUNT</th>
        </tr>

        <?php
        foreach ($payments as $payment) { ?>
            <tr>
                <td title="<?= $payment["txn_id"] ?>">
                    <code><?= substr($payment["txn_id"], 8, 15) ?>***</code><br>
                    <small><?= substr($payment["txn_time"], 0, 16) ?></small>
                </td>

                <td><?= $payment['reason'] ?></td>

                <td>
                    <span class="tag <?= $payment["status"] == 'PAID' ? 'green' : 'orange' ?>"> <?= $payment['status'] ?> </span>
                </td>

                <td> Rs. <?= $payment['amount'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>