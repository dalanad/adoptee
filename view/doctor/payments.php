<?php
$active = "payments";
require_once  __DIR__ . '/_nav.php';
?>
<div style="margin:0 auto">
    <h3 style="text-align:right;margin-bottom:0rem;font-weight:300">Account Balance : <b>Rs.<?= number_format($balance, 2, '.', ',')  ?></b> </h3>
    <h3 style="margin-left: 0rem;margin-bottom:0rem;margin-top:0rem">Transaction History</h3>
    <form method="get" action="" id="f_form" style="display: flex;align-items:center;margin-bottom:1rem;flex-wrap:wrap;line-height:1.5rem">
        <div style="white-space: nowrap;">
            <b>Transaction Type :</b> &nbsp;
            <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="type[]" <?= in_array("PAYMENT", $filter["type"]) ? "checked" : "" ?> value="PAYMENT" /> PAYMENT
            <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="type[]" <?= in_array("WITHDRAWAL", $filter["type"]) ? "checked" : "" ?> value="WITHDRAWAL" /> WITHDRAWAL
        </div>
        &nbsp; | &nbsp;
        <div style="white-space: nowrap;">
            <b>Status :</b> &nbsp;
            <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="status[]" <?= in_array("PAID", $filter["status"]) ? "checked" : "" ?> value="PAID" /> PAID
            <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="status[]" <?= in_array("REFUNDED", $filter["status"]) ? "checked" : "" ?> value="REFUNDED" /> REFUNDED
        </div>
        &nbsp; | &nbsp;
        <a href="/Doctor/payments" class="btn btn-link">Clear Filters</a>
        <span style="flex:1 1 0"></span>
        <button class="btn outline green" type="button" onclick='location.href="/Doctor/withdraw"' style=" margin:.5rem 0;" <?= $balance > 0 ? '' : 'disabled' ?>>
            <i class="far fa-credit-card"></i>&nbsp; Withdraw
        </button>
    </form>
    <div style="overflow-x:auto;">

        <table class="table">
            <tr>
                <th data-field="txn_id">Txn ID</th>
                <th data-field="txn_time">Date & Time</th>
                <th data-field="description">Description</th>
                <th>Type</th>
                <th>Status</th>
                <th style="text-align:right;">Amount</th>
            </tr>
            <?php foreach ($pay_history as $payment) { ?>
                <tr>
                    <td title="<?= $payment["txn_id"] ?>"> <code><?= substr($payment["txn_id"], 8, 15) ?>***</code></td>
                    <td style="white-space: nowrap;"><?= date('Y-m-d h:i A', strtotime(substr($payment["txn_time"], 0, 16))) ?></td>
                    <td><?= $payment["description"] ?? "WITHDRAWAL" ?></td>
                    <td><?= $payment["type"] ?></td>
                    <td>
                        <span class="tag <?= $payment["status"] == "PAID" ? 'green' : 'orange' ?>">
                            <?= $payment["status"] ?>
                        </span>
                    </td>
                    <td style="text-align:right;white-space:nowrap">
                        <?php if ($payment["status"] == 'PAID') { ?>
                            <?php if ($payment["type"] == 'PAYMENT') { ?>
                                <i class="fa fa-plus-square txt-clr green"></i>
                            <?php } else { ?>
                                <i class="fa fa-minus-square txt-clr red"></i>
                            <?php } ?>
                        <?php } ?>
                        &nbsp;
                        Rs. <?= $payment["amount"] ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php pagination($filter["page"], $filter["size"], $count) ?>
</div>

<style>
    table,
    td,
    th {
        border: 1px solid var(--muted);
        border-collapse: collapse;
    }
</style>