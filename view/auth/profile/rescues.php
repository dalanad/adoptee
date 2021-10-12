<style>
    th{
        width:5rem;
    }
</style>

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
                    <img src="<?=json_decode($value['photos'])[0] ?>" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                </td>
                <td><?= $value["type"] ?></td>
                <td><?= $value["location"] ?></td>
                <td><?= substr($value["time_reported"],0,10) ?></td>
                <td><?= $value["status"]=="RESCUED"? $value["rescued_date"] : "" ?></td>
                <td><span class="tag <?= $value["status"]=="RESCUED"? 'green' : 'orange'?>"><?=$value["status"]?> </span></td>
                <td><?= $value["status"]=="RESCUED"? ($value["o_name"]) : "" ?></td>
            </tr>
        <?php } ?>

    </table>
</div>