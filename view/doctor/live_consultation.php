<?php
$active = "live_consultation";
require_once  __DIR__ . '/_nav.php';
if (!isset($_GET["view"])) {
    $_GET["view"] = "day";
}
?>

<div style="display: grid;grid-template-columns:auto minmax(250px,300px);grid-gap:1rem">
    <div style="display: flex;align-items: center; font-size: 1.2em;margin-top:-.5rem">
        <span style="flex: 1 1 0"></span>
        <div class='dropdown' style="padding: 0;">
            <button class="btn btn-faded black">
                <i class='far fa-calendar-<?= $_GET["view"] ?>'></i>&nbsp; <?= ucfirst($_GET["view"]) ?>
            </button>
            <div class='dropdown-content'>
                <a class='btn black btn-link' href='#' onclick="params({view:'day'})"><i class='fal fa-calendar-day'></i>&nbsp; Day</a>
                <a class='btn black btn-link' href='#' onclick="params({view:'week'})"><i class='fal fa-calendar-week'></i>&nbsp; Week</a>
            </div>
        </div>
    </div>
    <div class="timeline-container" style="grid-column: 1;">
        <?php if ($_GET["view"] == "day") { ?>
            <div id="day-timeline"></div>
        <?php } else { ?>
            <div class="<?= $_GET["view"] ?>-view" id="appointments-timeline"></div>
        <?php } ?>
    </div>

    <div>
        <div style="box-shadow:var(--shadow);padding:1rem;aspect-ratio:1/1;margin-bottom:1rem;border-radius:.4rem;">
            <div style="text-align:center;" id="consultation-blank">
                <?php if ($_GET["view"] != "day") { ?>
                    <b>
                        Please Select an Appointment <br>
                        from the Timeline
                    </b>
                <?php } ?>
                <br><br>
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
    let view = '<?= $_GET["view"] ?>'

    let appointments_timeline = document.getElementById("appointments-timeline");

    let timeline = new AppointmentsTimeline(appointments_timeline);

    cal.onChange(async () => {

        if (view == 'day') {

            let url = new URL(window.location.href);
            let current_date = new Date(url.searchParams.get("calender_date") || new Date()).toISOString().substr(0, 10);
            let data = await fetch(`/doctor/get_live_bookings?start_date=${current_date}&end_date=${current_date}`).then((res) => res.json());
            showDayTimeline(current_date, data[current_date] ?? {})

        } else {


            timeline._date = cal._date;
            await timeline.render();
            await timeline.showBookings();

        }
    });

    cal.init();

    let status_colors = {
        PENDING: "orange",
        ACCEPTED: "-",
        CANCELLED: "red",
        COMPLETED: "green",
        EXPIRED: "pink",
    };

    timeline.onCellSelected(async (date, time, id) => populateInfoCard(id))

    async function populateInfoCard(consultation_id) {
        let data = await fetch("/api/get_consultation_by_id?consultation_id=" + consultation_id).then((e) => e.json());

        document.querySelector("#consultation-blank").style.display = 'none'
        document.querySelector("#consultation-info").innerHTML = `
            <h4 style='margin-top:0'>Consultation</h4>
            <div style="line-height:1.7em"> 
                <div>Date & Time : ${data.consultation_date} - ${data.consultation_time} </div>
                <div>Status : <span class="tag ${status_colors[data.status]}">${data.status}</span> </div>
                <div>Animal Name : ${data.animal.name} </div>
                <div>Animal Age : ${data.animal.age} Years  </div>
                <div>Animal Type : ${data.animal.type} </div>
                <div>Owner : ${data.user.name} </div>
            </div>
            ${ consultationActions(data) }
            `
    }

    function showDayTimeline(date, consultations) {

        let day_timeline = document.getElementById("day-timeline");

        day_timeline.innerHTML = `
            <div style="margin: 1rem; margin-bottom: 0.3rem;font-weight: 400;">
                <i class='fal fa-poll-people'></i> &nbsp; APPOINTMENTS ON : ${date}
            </div>
            <div style="max-height: calc(100vh - 13rem)">
                ${Object.values(consultations).map(single_consultation).join("")}
            </div>`

        function single_consultation(con) {

            let {
                status,
                animal,
                user
            } = con;

            let end_time = new Date("2021-08-01T" + con.consultation_time + "Z");
            end_time.setMinutes(end_time.getMinutes() + 30);

            return `<div>
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:.5rem 1rem;border-bottom:1px solid var(--gray-3)" >
                            <img src="${animal.photo}"  style ="height:80px;border-radius:.3rem"> 
                            <div style="width:10rem;margin-left:.5rem"> 
                                <b>${animal.name}</b>  <i class="far fa-${String(animal.type).toLowerCase()}"></i>
                                <div style="margin: 0.2em 0;" class="owner-name">${user.name} </div>
                                <small>${con.consultation_date} : ${con.consultation_time.substr(0, 5)} - ${end_time.toISOString().substr(11, 5)}</small>
                            </div>
                            <span style="flex:1 1 0"></span>
                               <div style="width:6rem;text-align:center">
                                <span class="tag ${status_colors[status]}">${status}</span>
                            </div>
                            <span style="flex:1 1 0"></span>
                            ${ consultationActions(con) }
                        </div>
                    </div>
                    `
        }

    }

    function consultationActions(con) {
        return `<div style="text-align:center;min-width:10rem">

                ${ (con.status == "PENDING")?
                    `<a class="btn green" onclick="accept_request(${con.consultation_id})">Accept</a> 
                     <a class="btn red  outline" onclick="reject_request(${con.consultation_id})">Cancel</a>`
                    : ``
                }

                ${ (con.status == "ACCEPTED"/*  && date == (new Date()).toISOString().substr(0,10) */ )?
                    `<a class="btn btn-faded pink" href="/doctor/consult_conference/${con.consultation_id}">
                        <i class="fa fa-video"></i> &nbsp; Consult
                    </a>`
                    : ``
                }
                </div>`
    }

    function accept_request(id) {
        showOverlay(`
            <h3 style='margin-top:0'>Accept Consultation ? &nbsp; &nbsp; &nbsp;</h3>
            <div style="display:flex;justify-content:space-between">
                <button class="btn red btn-faded overlay-close">Cancel</button>
                <a class="btn green" href="/doctor/accept_request?consultation_id=${id}">Accept</a> 
            </div>
        `)
    }

    function reject_request(id) {
        showOverlay(`
            <h3 style='margin-top:0'>Cancel Consultation ? &nbsp; &nbsp; &nbsp;</h3>
            <div style="display:flex;justify-content:space-between">
                <button class="btn black btn-faded overlay-close">Cancel</button>
                <a class="btn red" href="/doctor/reject_request?consultation_id=${id}">Cancel</a> 
            </div>
        `)
    }
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