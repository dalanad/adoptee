<style>
    .notif-card{
        border-radius: 6px;
        background: #fafafa;
        box-shadow: var(--shadow-light);
        cursor: pointer;
        display: grid;
        min-height: 3rem;
        padding-top: 1em;
        padding-left: 1em;
        margin-bottom: 1em;
    }

    /* .notif-card-action {
        display: none;
        text-align: center;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 2px;
        color: white;
        font-size: 1.4em;
        position: absolute;
        background: var(--primary);
    }

    .notif-card:hover .notif-card-action {
        display: flex;
     } */

     .icon{
        grid-column: 1 /1;
    }

    .date{
        grid-column: 2 / 2;
        color:dimgray;
        font-size:1rem;
        display: inline;
        margin-right: 1em;
    }

    .notif-type{
        grid-column:3 /3;
        font-size:1rem;
        display: inline;
        font-weight: bold;
        margin-left: 1em;
        margin-right: 1em;
    }

    .details{
        grid-column:4 / 4;
        margin-right: 1em;
    }

</style>
<div class="notif-card">
    <i class="fas fa-bell"></i>
    <div class="date"><?= date('Y-m-d') ?></div>
    <div class="notif-type">Adoption Request</div>
    <div class="details">Your adoption request has been approved!</div>
    <!-- <div class="notif-card-action">Go to Event</div> -->
</div>

<div class="notif-card">
    <i class="fas fa-bell"></i>
    <div class="date"><?= date('Y-m-d') ?></div>
    <div class="notif-type">Vaccination Reminder</div>
    <div class="details">Your pet Tina needs her ARV vaccine on 2021-09-20</div>
    <!-- <div class="notif-card-action">Go to Event</div> -->
</div>

<div class="notif-card" style="background:#E7E6E6;">
    <i class="far fa-bell"></i>
    <div class="date">2021-08-20</div>
    <div class="notif-type">Rescue Update</div>
    <div class="details">Reported pet progress</div>
    <!-- <div class="notif-card-action">Go to Event</div> -->
</div>