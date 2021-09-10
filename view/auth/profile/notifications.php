<style>
    .column {
        float: left;
        width: 30%;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .row{
        border-radius: 6px;
        background: #fafafa;
        box-shadow: var(--shadow-light);
        cursor: pointer;
        padding:0.5rem;
    }

    .date {
        color: dimgray;
        font-size: 1rem;
        width:20%
    }

    .notif-type {
        font-size: 1rem;
        font-weight: bold;
    }

    .fas{
        color:var(--green);
    }

    .fas, .far{
        width:10%;
    }

    .details{
        width:40%;
    }

    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
        }
    }
</style>

<div class="row mb2">
    <i class="column fas fa-bell"></i>
    <div class="column date"><?= date('Y-m-d') ?></div>
    <div class="column notif-type">Adoption Request</div>
    <div class="column details">Your adoption request has been approved!</div>
</div>

<div class="row mb2">
    <i class="column fas fa-bell"></i>
    <div class="column date"><?= date('Y-m-d') ?></div>
    <div class="column notif-type">Vaccination Reminder</div>
    <div class="column details">Your pet Tina needs her ARV vaccine on 2021-09-20</div>
</div>

<div class="row mb2" style="background:var(--gray-3);">
    <i class=" column far fa-bell"></i>
    <div class="column date">2021-08-20</div>
    <div class="column notif-type">Rescue Update</div>
    <div class="column details">Reported pet progress</div>
</div>