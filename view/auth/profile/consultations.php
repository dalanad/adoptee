<div style="margin-left:-1rem">
    <h3 style="margin : 0 1rem;">Your Consultations</h3>
    <table class="table">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Pet</th>
            <th>Doctor</th>
            <th>Type</th>
            <th>Status</th>
            <th> </th>
        </tr>
        <?php foreach ($consultations as $key => $value) { ?>
            <tr>
                <td style="font-size:0.9rem;"><?= $value['date'] ?></td>
                <td style="font-size:0.9rem;"><?= substr($value['time'], 0, 5) ?></td>
                <td><?= $value['pet'] ?></td>
                <td><?= $value['doctor'] ?></td>
                <td><span class="tag <?= $value['type'] == 'ADVISE' ? "green" : "orange" ?>"><?= $value['type'] ?></span></td>
                <td><?= $value['status'] ?></td>
                <td style="text-align: center;">
                    <?php if ($value['status'] == 'ACCEPTED') {
                        if ($value['type'] == 'LIVE') { ?>
                            <a class="btn outline" href="/Consultation/consult_live/<?= $value["consultation_id"] ?>"><i class="far fa-webcam"></i>&nbsp;Consult </a>
                        <?php } else { ?>
                            <a class="btn outline" href="/Consultation/consult_advise/<?= $value["consultation_id"] ?>"><i class="far fa-comments"></i> &nbsp; Chat</a>
                        <?php } ?>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>