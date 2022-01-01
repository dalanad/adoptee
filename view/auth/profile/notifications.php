<style>
    .row {
        border-radius: 6px;
        background: #fafafa;
        box-shadow: var(--shadow-light);
        cursor: pointer;
        padding: 0.5rem;
        display: flex;
    }

    .date {
        font-size: .8rem;
        margin-left: 1.3rem;
    }

    .details {
        padding-left: .5rem;
        border-left: 1px solid #ccc;
    }

    .fas {
        color: var(--green);
    }

    @media screen and (max-width: 600px) {
        .row {
            flex-direction: column;
        }
    }
</style>
<?php foreach ($notifications as $notification) { ?>
    <div class="row mb2">
        <div style="margin-right: .5rem;">
            <div><i class="fas fa-bell"></i> &nbsp;<b><?= $notification['title'] ?></b></div>
            <div class="date"><?= substr($notification['created_at'], 0, 16) ?></div>
        </div>
        <div class="details"><?= $notification['message'] ?></div>
    </div>
<?php } ?>