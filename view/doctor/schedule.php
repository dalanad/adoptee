<?php
$active = "schedule";
require_once  __DIR__ . '/_nav.php';
?>

<div style="display: grid;grid-template-columns:auto  ;grid-gap:1rem">
    <div style="display: flex;align-items: center; font-size: 1.2em;">
        Weekly Schedule
        <span style="flex: 1 1 0"></span>
        <span id="msg" class="txt-clr orange" style="font-size: .8em;"></span>&nbsp;
        <span style="flex: 1 1 0"></span>
        <button id="btn-edit" class="btn"><i class="far fa-pen"></i> &nbsp; Edit</button>&nbsp;
        <button id="btn-discard" style="display:none" class="btn pink btn-faded">Discard Changes</button>&nbsp;
        <button id="btn-save" style="display:none" class="btn green" disabled><i class="far fa-save"></i> &nbsp; Save</button>
    </div>
    <div class="timeline-container" style="grid-column: 1;">
        <div id="appointments-timeline"> </div>
    </div>
    <div>
    </div>
    <div></div>
</div>
<script src="/assets/js/live-consultations.js"></script>
<script>
    let appointments_timeline = document.getElementById("appointments-timeline");
    let schedule = new AppointmentsTimeline(appointments_timeline, true);

    let edit_button = document.getElementById("btn-edit")
    let discard_button = document.getElementById("btn-discard")
    let save_button = document.getElementById("btn-save")

    edit_button.onclick = function edit() {
        schedule.enableEditing()
        save_button.style.display = 'inline-flex'
        discard_button.style.display = 'inline-flex'
        document.getElementById("btn-edit").style.display = 'none'
    }

    discard_button.onclick = () => location.reload()

    save_button.onclick = async function save() {
        schedule.disableEditing()
        await schedule.saveSchedule()
        save_button.style.display = 'none'
        discard_button.style.display = 'none'
        edit_button.style.display = 'inline-flex'
        document.getElementById("msg").innerHTML = '';
        save_button.addAttribute("disabled")
    }

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