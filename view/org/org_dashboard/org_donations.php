<?php

$org_donations = array(
    array("donation_id" => 1, "donor" => "Sam", "amount" => "Rs.5 000", "email" => "sam@gmail.com", "date_received" => "20-10-2021", "special_notes" => "For Oliver's Medications"),
    array("donation_id" => 2, "donor" => "Susan", "amount" => "Rs.6 000", "email" => "susan@hotmail.com", "date_received" => "15-06-2021", "special_notes" => ""),
    array("donation_id" => 3, "donor" => "Jeffry", "amount" => "Rs.10 000", "email" => "jeff23@gmail.com", "date_received" => "01-01-2020", "special_notes" => "Spend on a special meal"),
    array("donation_id" => 4, "donor" => "Joseph", "amount" => "Rs.70 000", "email" => "josheph.6@yahoo.com", "date_received" => "12-10-2019", "special_notes" => ""),
);

?>

<div style="padding-top: 2rem;">
    <div class="overflow-auto" style="height:600px">
        <table class="table">
            <tr>
                <th>DONOR</th>
                <th>AMOUNT</th>
                <th>EMAIL</th>
                <th>DATE RECEIVED</th>
                <th>SPECIAL NOTES</th>
            </tr>

            <?php foreach ($org_donations as $org_donation) { ?>
                <tr>
                    <td>
                        <button class="btn btn-link btn-icon"><i class="fas fa-donate"></i></button> &nbsp
                        <?= $org_donation["donor"] ?>
                    </td>
                    <td><?= $org_donation["amount"] ?></td>
                    <td><?= $org_donation["email"] ?></td>
                    <td><?= $org_donation["date_received"] ?></td>
                    <td><?= $org_donation["special_notes"] ?></td>
                <?php } ?>

        </table>
    </div>
</div>