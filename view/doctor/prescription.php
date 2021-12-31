<?php require_once  __DIR__ . '/../_layout/layout.php'; ?>
<style>
    body {
        height: 95%
    }
</style>
<?php if (isset($consultationId)) { ?>
    <form style="padding:1rem;padding-top:0" method="POST" action="/prescription/save_consultation_prescription?consultation_id=<?= $consultationId ?>">

    <?php } else { ?>
        <form>
        <?php } ?>
        <h3 style="margin: 0.4rem;;font-weight:500"><i class="far fa-prescription"></i> &nbsp;
            <?= (!isset($_GET["view"])) ? "New" : "" ?> Prescription
        </h3>
        <table class="table no-pad">
            <tr>
                <th>Drug Name</th>
                <th style="text-align:center">Dose</th>
                <th style="text-align:center">Direction</th>
                <th style="text-align:right">Duration</th>
            </tr>
            <?php foreach ($prescription['items'] as $key => $item) { ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td style="text-align:center"><?= $item['dose'] ?></td>
                    <td style="text-align:center"><?= $item['direction'] ?></td>
                    <td style="text-align:right"><?= $item['duration'] ?></td>
                    <td style="text-align:right">
                        <?php if (!isset($_GET["view"])) { ?>
                            <!-- <button name="action" value="e" class="btn btn-link btn-icon"><i class="fas fa-pencil-alt"></i> </button> -->
                            &nbsp;
                            <button name="action" value='REMOVE-<?= $key ?>' class="btn btn-link btn-icon"><i class="fas fa-trash-alt"></i></button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <?php if (!isset($_GET["view"])) { ?>
            <div>
                <fieldset style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; margin:1rem 0;grid-column-gap:1rem;border-radius:.4rem;border:1px solid var(--gray-4);padding: 1rem;">
                    <legend style="padding: 0 0.4rem;">Add Drug</legend>
                    <div class="field">
                        <label>Drug Name</label>
                        <input class="ctrl" type="text" name="name">
                    </div>
                    <div class="field">
                        <label>Dose</label>
                        <input class="ctrl" type="text" name="dose">
                    </div>
                    <div class="field">
                        <label>Direction</label>
                        <input class="ctrl" type="text" name="direction">
                    </div>
                    <div class="field">
                        <label>Duration</label>
                        <input class="ctrl" type="text" name="duration">
                    </div>
                    <div>
                        <button name="action" value="ADD" class="btn">Add</button>
                    </div>
                </fieldset>
                <textarea name="remarks"><?= $prescription['remarks'] ?? "" ?></textarea>
                <div style="display: flex;justify-content:space-between">
                    <!-- <button type='button' class="btn btn-faded pink" onclick="document.querySelector('.overlay').remove()">Cancel</button> -->
                    <button class="btn green" name="action" value="SEND">Send</button>
                </div>
            </div>
        <?php } else { ?>
            <br>
            <b>Remarks :</b>
            <p><?= $prescription['content'] ?? "" ?></p>
        <?php } ?>

        </form>