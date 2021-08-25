<?php

$org_donations = array(
    array("donation_id" => 1, "donor" => "Sam", "amount" => "Rs.5 000", "email" => "abc@gmail.com", "date_received" => "01-01-2021"),
    array("donation_id" => 2, "donor" => "Susan", "amount" => "Rs.5 000", "email" => "abc@gmail.com", "date_received" => "01-01-2021"),
    array("donation_id" => 3, "donor" => "Jeffry", "amount" => "Rs.5 000", "email" => "abc@gmail.com", "date_received" => "01-01-2021"),
    array("donation_id" => 4, "donor" => "Joseph", "amount" => "Rs.5 000", "email" => "abc@gmail.com", "date_received" => "01-01-2021"),
);

?>

<div class="container">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        DONATIONS
    </h3>

    <div style="height:240px; overflow-x:hidden; overflow-y: auto;">
        <table class="table">
            <tr>
                <th>DONOR</th>
                <th>AMOUNT</th>
                <th>EMAIL</th>
                <th>DATE RECEIVED</th>
            </tr>

            <?php foreach ($org_donations as $org_donation) { ?>
                <tr style="font-size: 0.8rem;">
                    <td>
                        <button class="btn btn-link btn-icon"><i class="fas fa-donate"></i></button> &nbsp
                        <?= $org_donation["donor"] ?>
                    </td>
                    <td><?= $org_donation["amount"] ?></td>
                    <td><?= $org_donation["email"] ?></td>
                    <td><?= $org_donation["date_received"] ?></td>
                <?php } ?>

        </table>
    </div>
</div>