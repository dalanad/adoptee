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
    <div>
        <a href="/OrgManagement/org_rescues" class="btn btn-link btn-icon mr1 " style="font-size: 1em;"><i class="fa fa-arrow-left"></i></a>
    </div>
    <h3 class='mt1 txt-clr'>Add Update</h3>
    <form action="/OrgManagement/add_rescue_update" method="post">
        <div class="field">
            <label for='description'>Description</label>
            <textarea rows="6" class="ctrl field-font" name="description" placeholder="Update Description"></textarea>
            <span class="field-msg"> </span>
        </div>

        <div class="field ">
            <label>Upload Photo</label>
            <div class="ctrl-group field-font">
                <span class="ctrl static"><i class="fa fa-photo-video"></i></span>
                <input class="ctrl field-font" type="file" name="photo" multiple />
            </div>
            <span class="field-msg"> </span>
        </div>
        <br>

        <button class='btn mr2' type='reset'>Clear</button>
        <button class='btn mr2' type="submit">Add Update</button>
    </form>

</div>