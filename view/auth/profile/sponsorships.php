<style>
    th {
        font-weight: bold;
    }
</style>

<div class="overflow-auto" style="height:450px">
    <h3 style="margin:0rem;">My Sponsorships</h3>
    <table class="table">
        <tr>
            <th>START DATE</th>
            <th>ORGANIZATION</th>
            <th>TIER</th>
            <th>PURPOSE</th>
            <th>AMOUNT</th>
            <th>END DATE</th>
        </tr>

        <?php
        foreach ($subscriptions as $key=>$value) { ?>
            <tr>
                <td><?= $value['start_date'] ?></td>
                <td><?= $value['org'] ?></td>
                <td><?= $value['name'] ?></td>
                <td><?= $value['description'] ?></td>
                <td>Rs.&nbsp;<?= $value['amount_at_subscription'] ?></td>
                <td><?= $value['end_date']?? "-" ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

