<style>
    th {
        font-weight: bold;
    }
</style>

<div class="overflow-auto" style="height:450px">
    <table class="table">
        <tr>
            <th>ORGANIZATION</th>
            <th>TIER</th>
            <th>AMOUNT</th>
            <th>RECURRING DAYS</th>
            <th>DESCRIPTION</th>
        </tr>
        <?php foreach ($sponsorship as $key => $value) { ?>
            <tr>
                <td><?= $value['o_name'] ?></td>
                <td><?= $value['name'] ?></td>
                <td>Rs.<?= $value['amount'] ?></td>
                <td><?= $value['recurring_days'] ?></td>
                <td><?= $value['description'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>