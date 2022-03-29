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
    <a class="btn btn-faded black" href="/OrgManagement/org_rescues" style="margin: .5rem 0rem; "><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
    <h2 style="margin:0">Add Rescue Update</h2>

    <form action="/OrgManagement/process_add_rescue_update" method="post" enctype="multipart/form-data">
        <div class="field">
            <label for='heading'>Heading</label>
            <textarea rows="6" class="ctrl field-font" name="heading" placeholder="Update Heading"></textarea>
            <span class="field-msg"> </span>
        </div>
        <input type="hidden" name="report_id" value="<?= $_GET["report_id"] ?>" />

        <div class="field">
            <label for='description'>Description</label>
            <textarea rows="6" class="ctrl field-font" name="description" placeholder="Update Description"></textarea>
            <span class="field-msg"> </span>
        </div>

        <div class="field ">
            <label>Upload Photo</label>
            <div class="ctrl-group field-font">
                <span class="ctrl static"><i class="fa fa-photo-video"></i></span>
                <input class="ctrl field-font" type="file" name="photo" required />
            </div>
            <span class="field-msg"> </span>
        </div>
        <br>

        <button class='btn mr2' type="submit">Add Update</button>
        <button class='btn mr2 btn-faded pink' type='reset'>Clear</button>
    </form>

</div>