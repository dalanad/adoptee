<?php
$active = "schedule";
require_once  __DIR__ . '/_nav.php';
?>

<div style="display: grid;grid-template-columns:auto;grid-gap:0rem;max-width:900px;margin:0 auto">
    <form action="/Doctor/update_pricing" method="POST">
        <div style="font-size: 1.1em;margin-bottom:.5rem">Charges</div>
        <div style="display: flex;max-width:30rem">
            <div class="field">
                <label>Appointment - Live</label>
                <div class="ctrl-group">
                    <span class="ctrl static">Rs.</span>
                    <input class="ctrl" type="number" style="text-align: right;" name="live" value="<?= $doctor["live_charge"] ?>">
                    <span class="ctrl static">.00</span>
                </div>
            </div>
            &nbsp;
            &nbsp;
            <div class="field">
                <label>Chat / Advise</label>
                <div class="ctrl-group">
                    <span class="ctrl static">Rs.</span>
                    <input class="ctrl" type="number" style="text-align: right;" name="advise" value="<?= $doctor["advise_charge"] ?>">
                    <span class="ctrl static">.00</span>
                </div>
            </div>
            &nbsp;
            &nbsp;
            <div class="field">
                <label>&nbsp;</label>
                <button class="btn">Update</button>
            </div>
        </div>
    </form>
    <div style="display: flex;align-items: center; margin-bottom:.5rem ">
        <span style="font-size: 1.1em;"> Weekly Schedule</span>
        <span style="flex: 1 1 0"></span>
        <span id="msg" class="txt-clr orange" style="font-size: .8em;"></span>&nbsp;
        <span style="flex: 1 1 0"></span>
        <div class="field" id="charge" style="max-width: 8em;display:none;padding:0">
            <div class="ctrl-group">
                <span class="ctrl static">Rs.</span>
                <input class="ctrl" value="2000" min="0" type="number">
            </div>
        </div>
        <button id="btn-edit" class="btn"><i class="far fa-pen"></i> &nbsp; Edit</button>&nbsp;
        <button id="btn-discard" style="display:none" class="btn pink btn-faded">Discard Changes</button>&nbsp;
        <button id="btn-save" style="display:none" class="btn green" disabled><i class="far fa-save"></i> &nbsp; Save</button>
    </div>
    <div class="timeline-container" style="grid-column: 1;">
        <div id="appointments-timeline"> </div>
    </div>

</div>
<script>
    let appointments_timeline = document.getElementById("appointments-timeline");
    let schedule = new AppointmentsTimeline(appointments_timeline, true);

    let edit_button = document.getElementById("btn-edit")
    let discard_button = document.getElementById("btn-discard")
    let save_button = document.getElementById("btn-save")
    let charge_input = document.getElementById("charge")

    edit_button.onclick = function edit() {
        schedule.enableEditing()
        save_button.style.display = 'inline-flex'
        discard_button.style.display = 'inline-flex'
        // charge_input.style.display = 'inline-flex'
        document.getElementById("btn-edit").style.display = 'none'
    }

    discard_button.onclick = () => location.reload()

    save_button.onclick = async function save() {
        schedule.disableEditing()
        await schedule.saveSchedule()
        save_button.style.display = 'none'
        charge_input.style.display = 'none'
        discard_button.style.display = 'none'
        edit_button.style.display = 'inline-flex'
        document.getElementById("msg").innerHTML = '';
        save_button.addAttribute("disabled")
    }

    schedule.charge = 2000
    charge_input.querySelector("input").addEventListener("change", (e) => {
        schedule.charge = e.target.value
    })

    schedule.onChange(() => {
        save_button.removeAttribute("disabled")
        document.getElementById("msg").innerHTML = '<i class="far fa-exclamation-triangle"></i> Unsaved Changes';
    });
</script>

<style>
    #appointments-timeline.editing .cell:not(.heading),
    #appointments-timeline.editing .timeline-column {
        border-color: var(--gray-4);
    }

    #appointments-timeline.editing .timeline-column:nth-child(2n) {
        transition: background-color .3s ease;
        background: #f1f1f1;
    }
</style>