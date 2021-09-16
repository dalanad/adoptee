<h3 style="margin-left:1rem;">My Rescues</h3>
<div class="overflow-auto" style="height:450px">
    <table class="table">
        <tr>
            <th></th>
            <th>TYPE</th>
            <th>LOCATION</th>
            <th>REPORTED DATE</th>
            <th>RESCUED DATE</th>
            <th>STATUS</th>
            <th>RESPONDED ORGANIZATION</th>
        </tr>


        <?php foreach ($data as $key => $value) { ?>
            <tr style="font-size: 0.8rem;">
                <td>
                    <img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                </td>
                <td><?= $value["type"] ?></td>
                <td><?= $value["location"] ?></td>
                <td><?= $value["date_reported"] ?></td>
                <td><?= $value["rescued_date"] ?></td>
                <td><?= $value["status"] ?></td>
                <td><?= $value["o_name"] ?></td>
            </tr>
        <?php } ?>

    </table>
</div>