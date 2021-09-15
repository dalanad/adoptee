<?php

$users = array(
    array("id" => 1, "name" => "Dalana ", "amount" => "Rs 1000.00", "sdt" => "2021-05-06 10.00 AM", "reason" => true),
    array("id" => 2, "name" => "Dalana", "amount" => "Rs 1000.00", "sdt" => "2021-05-06 10.00 AM", "reason" => false),
    array("id" => 3, "name" => "Dalana", "amount" => "Rs 1000.00", "sdt" => "2021-05-06 10.00 AM", "reason" => true),

);


?>
<style>
    .table th {
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .table td {
        font-size: 0.9rem;
    }
</style>

<div class="flex-auto   mx2 " style="padding:5px">
    <br>
    <span style="font-size:22px">Payments Recieved</span>
    <table class="table">
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Date & Time</th>
                <th>Reason</th>
            </tr>

            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user["name"] ?></td>
                    <td><?= $user["amount"] ?></td>
                    <td><?= $user["sdt"] ?></td>
                    <td><?= $user["reason"] ? "DONATION" : "PURCHASE" ?></td>


                </tr>
            <?php } ?>

        </table>
</div>
 