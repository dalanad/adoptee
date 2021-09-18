<?php require_once  __DIR__ . '/../_layout/layout.php'; ?>
<div style="padding:1rem;padding-top:0">
    <h3 style="margin: 0.4rem;;font-weight:500"><i class="far fa-prescription"></i> &nbsp;New Prescription</h3>
    <table class="table no-pad">
        <tr>
            <th>Drug Name</th>
            <th style="text-align:center">Dose</th>
            <th style="text-align:center">Direction</th>
            <th style="text-align:right">Duration</th>
        </tr>
        <?php for ($i = 0; $i < 5; $i++) { ?>
            <tr>
                <td>Laxapet Palatable</td>
                <td style="text-align:center">100mg</td>
                <td style="text-align:center">3 TD</td>
                <td style="text-align:right">5 Days</td>
                <td style="text-align:right">
                    <a class="btn btn-link btn-icon"><i class="fas fa-pencil-alt"></i> </a>
                    &nbsp;
                    <a class="btn btn-link btn-icon"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div>
        <fieldset style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
        margin:1rem 0;grid-column-gap:1rem;border-radius:.4rem;border:1px solid var(--gray-4);padding: 1rem;">
            <legend style="padding: 0 0.4rem;">Add Drug</legend>
            <div class="field">
                <label>Drug Name</label>
                <input class="ctrl" type="text">
            </div>
            <div class="field">
                <label>Dose</label>
                <input class="ctrl" type="text">
            </div>
            <div class="field">
                <label>Direction</label>
                <input class="ctrl" type="text">
            </div>
            <div class="field">
                <label>Duration</label>
                <input class="ctrl" type="text">
            </div>
            <div>
                <button class="btn">Add</button>
            </div>
        </fieldset>
        <div style="display: flex;justify-content:space-between">
            <button class="btn btn-faded pink">Cancel</button>
            <button class="btn green">Save</button>
        </div>
    </div>
</div>