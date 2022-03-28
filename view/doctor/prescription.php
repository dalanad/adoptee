<?php require_once  __DIR__ . '/../_layout/layout.php'; ?>
<style>
    body {
        height: 95%
    }

    .auto-complete {
        position: relative;
        display: inline-block;
    }

    .auto-complete-content {
        display: none;
        position: absolute;
        min-width: 100%;
        box-sizing: border-box;
        padding: 0.5rem 0;
        margin-top: .3rem;
        top: 100%;
        border: var(--border);
        border-radius: 0.3rem;
        overflow: auto;
        box-shadow: var(--shadow);
        z-index: 1000;
        background: white;
        right: 0;
        max-height: 180px;
    }

    .auto-complete.show .auto-complete-content {
        display: block;
    }

    .auto-complete-content .item:hover {
        background: var(--gray-2);
    }

    .auto-complete-content .item {
        padding: 0.5rem 1rem;
        display: block;
        border-radius: 0;
        text-decoration: none;
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
                        <input class="ctrl" type="text" name="name" id="drug-input">
                        <div class='auto-complete' style='display:flex;align-items: center;line-height: 1;'>
                            <div class='auto-complete-content'> </div>
                        </div>
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

                <script>
                    let meds = <?= json_encode($medicines) ?>;
                    let input = document.getElementById('drug-input');
                    let autocomplete = document.querySelector('.auto-complete');
                    let content = document.querySelector('.auto-complete-content')

                    input.addEventListener('focus', () => {
                        autocomplete.classList.add('show')
                        content.innerHTML = ''
                        showFiltered()
                    })

                    input.addEventListener('focusout', () => {
                        setTimeout(() => {
                            autocomplete.classList.remove('show')
                            content.innerHTML = ''
                        }, 200)
                    })

                    function setValue(v) {
                        input.value = v;
                    }

                    function showFiltered() {
                        let filterd = meds.filter(e => String(e.name).toLowerCase().includes(String(input.value).toLowerCase()))
                        if (filterd.length > 0) {
                            content.innerHTML = filterd.map(e => `<div class='item' onclick="setValue('${e.name}')">${e.name}</div>`).reduce((a, b) => a + b)

                        } else {
                            content.innerHTML = ''
                        }
                    }

                    input.addEventListener('keyup', () => {
                        showFiltered()
                    })
                </script>

                Remarks
                <textarea class="ctrl" name="remarks"><?= $prescription['remarks'] ?? "" ?></textarea>
                <br>
                <br>
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