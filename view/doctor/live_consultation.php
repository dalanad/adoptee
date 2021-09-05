<?php
$active = "live_consultation";
require_once  __DIR__ . '/_nav.php';
?>

<div style="display: grid;grid-template-columns:auto minmax(250px,300px);grid-gap:1rem">
    <div style="display: flex;align-items: center; font-size: 1.2em;">
        Current Appointments
        <span style="flex: 1 1 0"></span>
    </div>
    <div class="timeline-container" style="grid-column: 1;">
        <div id="appointments-timeline"> </div>
    </div>

    <div>
        <div style="box-shadow:var(--shadow);padding:1rem;aspect-ratio:1/1;margin-bottom:1rem;border-radius:.4rem;">
            <div style="text-align:center;" id="consultation-blank">
                <b>
                    Please Select an Appointment <br>
                    from the Timeline
                </b><br><br>
                <img src="/assets/images/graphics/caring.svg" style="max-width: 200px;opacity:.4">
            </div>
            <div id="consultation-info"></div>
        </div>
        <div class="calender" style="box-shadow:var(--shadow);padding:1rem;border-radius:.4rem"> </div>
    </div>
    <div></div>
</div>
<script src="/assets/js/live-consultations.js"></script>
<script>
    //status enum('CANCELLED','PENDING','ACCEPTED','COMPLETED') not null default 'PENDING', 
    //type enum('LIVE','ADVISE') not null default 'ADVISE',
    let sample = {
        consultation_id: "5511445",
        consultation_date: '2021-08-30',
        consultation_time: '08:30:00',
        animal_id: 10,
        doctor_user_id: (10),
        user_id: (10),
        status: 'PENDING',
        type: 'LIVE',
        payment_txn_id: '',
        animal_id: 1,
        animal_type: 'DOG'
    };

    appointments = {
        "2021-08-30": {
            "08:30:00": sample,
            "09:00:00": sample,
            "09:30:00": sample,
        },
        "2021-08-31": {
            "08:30:00": sample,
            "09:00:00": sample,
            "12:30:00": sample,
            "13:00:00": sample,
            "13:30:00": sample,
        },
        "2021-09-01": {
            "08:30:00": sample,
            "12:00:00": sample,
            "12:30:00": sample,
            "13:00:00": sample,
            "13:30:00": sample,
            "14:00:00": sample,
        },
        "2021-09-02": {},
        "2021-09-03": {
            "09:30:00": sample,
            "10:30:00": sample,
            "11:00:00": sample,
            "21:30:00": null
        },
        "2021-09-04": {
            "08:30:00": sample,
            "09:30:00": sample,
            "11:00:00": sample,
        },
        "2021-09-05": {
            "21:30:00": sample
        }
    }

    let cal_el = document.querySelector(".calender");
    let cal = new Calender(cal_el);

    let appointments_timeline = document.getElementById("appointments-timeline");

    let timeline = new AppointmentsTimeline(appointments_timeline);

    cal.onChange(() => {
        timeline._date = cal._date;
        timeline.render();
    });

    timeline.onCellSelected((date, time, data) => {
        document.querySelector("#consultation-blank").style.display = 'none'
        document.querySelector("#consultation-info").innerHTML = '<small><pre>' + JSON.stringify({
            date,
            time,
            data
        }, null, 1) + '</pre>'
    })
</script>
<style>
    .cell.selected {
        /* background-color: var(--gray-1); */
        border :2px dashed; 
        border-color: var(--primary); }

    .cell.has-data {
    }

    .cell.has-data:hover {
        cursor: pointer;
        background-color: var(--gray-1);
    }
</style>