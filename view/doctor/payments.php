<?php
$active = "payments";
require_once  __DIR__ . '/_nav.php';
?>
<div style="max-width: 900px;margin:0 auto">
    <h3 style="text-align:right;margin-bottom:0rem;font-weight:300">Account Balance : <b>Rs.<?= $balance ?></b> </h3>
    <div style="text-align: right;">
        <button class="btn outline green" onclick='location.href="/Doctor/withdraw"' style=" margin:.5rem 0;" <?= $balance > 0 ? '' : 'disabled' ?>>
            <i class="far fa-credit-card"></i>&nbsp; Withdraw
        </button>
    </div>
    <h3 style="margin-left: 1rem;margin-bottom:0rem;margin-top:1rem">Transaction History</h3>
    <table class="table">
        <tr>
            <th>Txn ID</th>
            <th>Date & Time</th>
            <th>Description</th>
            <th style="text-align:right;">Amount</th>
        </tr>
        <?php foreach ($pay_history as $payment) { ?>
            <tr>
                <td title="<?= $payment["txn_id"] ?>"> <code><?= substr($payment["txn_id"], 8, 15) ?>***</code></td>
                <td><?= substr($payment["txn_time"], 0, 16) ?></td>
                <td>
                    <?= $payment["description"] ?? "WITHDRAWAL" ?></td>
                <td style="text-align:right;">
                    <?php if ($payment["type"] == 'PAYMENT') { ?>
                        <i class="fa fa-plus-square txt-clr green"></i>
                    <?php } else { ?>
                        <i class="fa fa-minus-square txt-clr red"></i>
                    <?php } ?> &nbsp;
                    Rs. <?= $payment["amount"] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>