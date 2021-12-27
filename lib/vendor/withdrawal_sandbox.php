<?php
function rndId()
{
    return base_convert((rand() * time()) + 100, 10, 36);
}

$txn_id =  rndId() . rndId() . rndId();
?>

<div style="border: 1px solid black;padding:1rem">
    <div>
        Adoptee - GROUP 26 <b style="float:right;"></b>
        <br>
        <b style="font-size:1.5rem">Withdrawal Sandbox </b> <span style="float:right"> Payment Gateway </span>
    </div>
    <br>
    <p>Amount to Withdraw = Rs.<?= $_GET['amount'] ?></p>
    <p>Transaction Outcome :
        <a href="/Doctor/withdraw_callback?amount=<?= $_GET['amount'] ?>&txn_id=<?= $txn_id ?>&status=SUCCESS" style='color:green'>SUCCESS</a> |
        <a href="/Doctor/withdraw_callback?status=ERROR" style='color:red'>ERROR</a> |
        <a href="/Doctor/withdraw_callback?status=CANCELED">CANCEL</a>
    </p>
    <small>** This is a sandbox environment for simulating a withdrawal transaction </small>
</div>

<style>
    body {
        font-family: monospace;
        width: 500px;
        font-size: 18px;
        margin: 2rem auto;
    }
</style>