<?php
$active = "payments";
require_once  __DIR__ . '/_nav.php';
?>
<div style="max-width: 900px;margin:0 auto">
    <h3 style="text-align:right;margin-bottom:0rem;font-weight:300">Account Balance : <b>Rs.5500</b> </h3>
    <div style="text-align: right;">
        <button class="btn outline green" style=" margin:.5rem 0;"><i class="far fa-credit-card"></i>&nbsp; Payout</button>

    </div>
    <h3 style="margin-left: 1rem;margin-bottom:0rem;margin-top:1rem">Transaction History</h3>
    <table class="table">
        <tr>
            <th>Txn ID</th>
            <th>Date</th>
            <th>Description</th>
            <th style="text-align:right;">Amount</th>
        </tr>
        <tr>
            <td>587495854</td>
            <td>2021-08-27</td>
            <td>Payment for Advice</td>
            <td style="text-align:right;"><i class="fa fa-plus-square txt-clr green"></i> &nbsp; Rs. 2000</td>
        </tr>
        <tr>
            <td>587449378</td>
            <td>2021-08-26</td>
            <td>Payment for Consultation</td>
            <td style="text-align:right;"><i class="fa fa-plus-square txt-clr green"></i> &nbsp; Rs. 2500</td>
        </tr>
        <tr>
            <td>587445875</td>
            <td>2021-08-22</td>
            <td>Pay out</td>
            <td style="text-align:right;"><i class="fa fa-minus-square txt-clr red"></i> &nbsp; Rs. 2000</td>
        </tr>
        <tr>
            <td>587445813</td>
            <td>2021-08-21</td>
            <td>Payment for Consultation</td>
            <td style="text-align:right;"><i class="fa fa-plus-square txt-clr green"></i> &nbsp; Rs. 2000</td>
        </tr>
    </table>
</div>