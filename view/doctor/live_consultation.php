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
    let sample = () => ({
        consultation_id: Math.round(Math.random() * 10E7),
        consultation_date: '2021-08-30',
        consultation_time: '08:30:00',
        animal_id: Math.round(Math.random() * 10E3),
        doctor_user_id: (10),
        user_id: (Math.round(Math.random() * 10E2)),
        status: ['PENDING', 'ACCEPTED', 'ACCEPTED', 'ACCEPTED', 'CANCELLED'][Math.round(Math.random() * 4)],
        type: 'LIVE',
        payment_txn_id: '',
        animal_id: 1,
        animal_type: ['DOG', 'DOG', 'CAT', 'CAT', 'DOVE'][Math.round(Math.random() * 4)]
    });

    appointments = {
        "2021-08-30": {
            "08:30:00": sample(),
            "09:00:00": sample(),
            "09:30:00": sample(),
        },
        "2021-08-31": {
            "08:30:00": sample(),
            "09:00:00": sample(),
            "12:30:00": sample(),
            "13:00:00": sample(),
            "13:30:00": sample(),
        },
        "2021-09-01": {
            "08:30:00": sample(),
            "12:00:00": sample(),
            "12:30:00": sample(),
            "13:00:00": sample(),
            "13:30:00": sample(),
            "14:00:00": sample(),
        },
        "2021-09-02": {},
        "2021-09-03": {
            "09:30:00": sample(),
            "10:30:00": sample(),
            "11:00:00": sample(),
            "21:30:00": null
        },
        "2021-09-04": {
            "08:30:00": sample(),
            "09:30:00": sample(),
            "11:00:00": sample(),
        },
        "2021-09-05": {
            "21:30:00": sample()
        }
    }

    let cal_el = document.querySelector(".calender");
    let cal = new Calender(cal_el);

    let appointments_timeline = document.getElementById("appointments-timeline");

    let timeline = new AppointmentsTimeline(appointments_timeline);

    cal.onChange(async () => {
        timeline._date = cal._date;
        await timeline.render();
        await timeline.showBookings();
    });

    timeline.onCellSelected((date, time, data) => {
        document.querySelector("#consultation-blank").style.display = 'none'
        document.querySelector("#consultation-info").innerHTML = `
        <h4 style='margin-top:0'>Consultation</h4>
        <div style="line-height:1.7em"> 
            <div>Date & Time : ${date} - ${time} </div>
            <div>Status : <span class="tag green">${data.status}</span> </div>
            <div>Animal Name : Zeus </div>
            <div>Animal Age : 3 Years  </div>
            <div>Animal Type : ${data.animal_type} </div>
            <div>Owner : Mr. Perera </div>
        </div>
        <div style="text-align:center;margin-top:1rem">
            <a class="btn pink" href="/doctor/consult_conference">
                <i class="fa fa-video"></i> &nbsp; Consult
            </a>
        </div>
        `
    })
</script>
<style>
    .cell.selected {
        /* background-color: var(--gray-1); */
        border: 2px dashed;
        border-color: var(--primary);
    }

    .cell.has-data {}

    .cell.has-data:hover {
        cursor: pointer;
        background-color: var(--gray-1);
    }
</style>