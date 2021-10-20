<?php
$active = "live_consultation";
require_once  __DIR__ . '/_nav.php';
if(!isset($_GET["view"])){
    $_GET["view"] = "day";
}
?>

<div style="display: grid;grid-template-columns:auto minmax(250px,300px);grid-gap:1rem">
    <div style="display: flex;align-items: center; font-size: 1.2em;">
        Current Appointments
        <span style="flex: 1 1 0"></span>
        <div class='dropdown'>
            <button class="btn btn-faded black">
                <?php if ($_GET["view"] == "day") { ?>
                    <i class='far fa-calendar-day'></i>&nbsp; Day
                <?php } else { ?>
                    <i class='far fa-calendar-week'></i>&nbsp; Week
                <?php } ?>
            </button>
            <div class='dropdown-content'>
                <a class='btn black btn-link' href='#' onclick="params({view:'day'})"><i class='fal fa-calendar-day'></i>&nbsp; Day</a>
                <a class='btn black btn-link' href='#' onclick="params({view:'week'})"><i class='fal fa-calendar-week'></i>&nbsp; Week</a>
            </div>
        </div>
    </div>
    <div class="timeline-container" style="grid-column: 1;">
        <div class="<?= $_GET["view"] ?>-view" id="appointments-timeline"></div>
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
<script>
    let cal_el = document.querySelector(".calender");
    let cal = new Calender(cal_el);

    let appointments_timeline = document.getElementById("appointments-timeline");

    let timeline = new AppointmentsTimeline(appointments_timeline);

    cal.onChange(async () => {
        timeline._date = cal._date;
        await timeline.render();
        await timeline.showBookings();
    });

    cal.init();

    let status_colors = {
        PENDING: "orange",
        ACCEPTED: "-",
        CANCELLED: "red",
        COMPLETED: "green",
        EXPIRED: "pink",
    };

    timeline.onCellSelected((date, time, data) => {
        document.querySelector("#consultation-blank").style.display = 'none'
        document.querySelector("#consultation-info").innerHTML = `
        <h4 style='margin-top:0'>Consultation</h4>
        <div style="line-height:1.7em"> 
            <div>Date & Time : ${date} - ${time} </div>
            <div>Status : <span class="tag ${status_colors[data.status]}">${data.status}</span> </div>
            <div>Animal Name : ${data.animal.name} </div>
            <div>Animal Age : ${data.animal.age} Years  </div>
            <div>Animal Type : ${data.animal.type} </div>
            <div>Owner : ${data.user.name} </div>
        </div>
        <div style="text-align:center;margin-top:1rem">

        ${ (data.status == "PENDING")?
            `<a class="btn green" href="#">Accept</a> <a class="btn red btn-link" href="#">Cancel</a>`
            : ``
        }

        ${ (data.status == "ACCEPTED"/*  && date == (new Date()).toISOString().substr(0,10) */ )?
            `<a class="btn pink" href="/doctor/consult_conference/${data.consultation_id}">
                <i class="fa fa-video"></i> &nbsp; Consult
            </a>`
            : ``
        }
        </div>
        `
    })
</script>
<style>
    .booking {
        border: 1px solid var(--primary);
        position: relative;
        background: white;
        padding: 0;
        display: block;
    }

    .booking:hover {
        cursor: pointer;
        outline: 3px solid var(--primary);
        z-index: 100;
    }

    .booking::before {
        background: var(--primary);
        content: " ";
        display: block;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 10%;
        position: absolute;
    }

    .booking .pet-img {
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
    }

    .booking .status {
        font-size: .8em;
        font-weight: 500;
        padding: .1em 0;
        text-transform: uppercase;
        background: var(--primary);
        color: white;
        outline: 1px solid var(--primary);
    }


    .booking.selected {
        outline: 3px dashed var(--primary) !important;
        z-index: 50;
        outline-offset: 2px;
    }

    .booking .content {
        padding: .4em;
    }


    .day-view .timeline-column:not(.active):not(:first-child) {
        display: none;
    }

    .day-view#appointments-timeline {
        grid-template-columns: 80px 1fr;
    }

    .day-view .timeline-column.active::before {
        background: none !important;
    }
</style>