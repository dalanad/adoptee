<?php require __DIR__ . "/../../_layout/header.php"; ?>

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
    <div class='placeholder-box mr1' style='height:50px; width:100px;'>Logo</div>
    <div>
        <a href="/OrgManagement/org_news_events" class="btn btn-link btn-icon mr1 " style="font-size: 1em;"><i class="fa fa-arrow-left"></i></a>
    </div>
    <h3 class='mt1 txt-clr'>Add New Event</h3>
    <form action="/OrgManagement/add_new_event" method="post">
        <div class="field">
            <label for='name'>Event Name</label>
            <input class="ctrl field-font" type="text" name="name" required/>
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
        <input type="file" name="photo[]" class="ctrl" multiple accept="image/*" required>
      </div>
      <span class="field-msg">Upload a photo of the event</span>
    </div>
    <br>
        <br>

        <button class='btn mr2' type='reset'>Clear</button>
        <button class='btn mr2' type="submit">Add Update</button>
    </form>

</div>