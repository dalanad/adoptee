<?php require __DIR__ . "/../../_layout/layout.php"; ?>

<style>
    .ctrl2 {
        padding: 0.4em 0.5em;
        line-height: 1;
        border-radius: 8px;
        font-family: inherit;
        color: var(--color);
        font-size: 1rem;
        border: 0.2rem solid var(--gray-2);
        background: var(--gray-1);
        width: 25%;
        box-sizing: border-box;
    }


    .box {
        display: none;
    }
</style>


<div class='container px2'>
    <a class="btn btn-faded black" href="/OrgManagement/org_news_events" style="margin: .5rem 0rem; "><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
    <h2 >Add New Event</h2>

    <form action="/OrgManagement/process_add_new_event" method="post"  enctype="multipart/form-data">
        <div class="field">
            <label for='name'>Event Name</label>
            <input class="ctrl field-font" type="text" name="heading" required />
        </div>
        <div class="field">
            <div>
                <label for='description'>Description</label>
                <textarea rows="6" class="ctrl field-font" name="description" required></textarea>
            </div>
            <div>
                <span class="field-msg">Update Description</span>
            </div>
        </div>

        <div class="field ">
            <label>Upload Photo</label>
            <div class="ctrl-group">
                <span class="ctrl static"><i class="fa fa-photo-video"></i></span>
                <input type="file" name="photo" class="ctrl" accept="image/*" required>
            </div>
            <span class="field-msg">Upload a photo of the event</span>
        </div>
        <br>
        <br>

        <button class='btn mr2' type="submit">Add Event</button>
        <button class='btn mr2 btn-faded pink' type='reset'>Clear</button>
    </form>

</div>