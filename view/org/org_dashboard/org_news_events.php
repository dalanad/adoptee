<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        margin: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border: 1px solid #888;
        width: 25%;
        position: absolute;
    }

    .update-form {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        margin: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border: 1px solid #888;
        width: 75%;
        position: absolute;

    }

    .mouse-over-div {
        border: 1px solid var(--gray-3);
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }


    .event-content {
        padding-left: 1rem;
        padding-right: 1rem;
        text-align: justify;
        font-size: 0.9rem;
    }

    .event-image {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid var(--gray-3);
        margin-bottom: 2rem;
        object-fit: cover;
        width: 380px;
        height: 200px;
        border-radius: 0.5rem;
    }

    .div-size {
        min-height: 3rem;
        margin-bottom: 1rem;
    }

    .button-hover:hover {
        background-color: var(--primary);
        color: white;
        transition: opacity 0.2s ease-in;
    }

    .div-edit-delete {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        cursor: pointer;
        text-align: center;
        padding: 2px;
        border-right: 3px solid var(--gray-3);
        border-top: 3px solid var(--gray-3);
        border-bottom: 3px solid var(--gray-3);
    }

    .div-edit-delete:hover {
        transition: border-color .2s ease-in-out;
        border-color: var(--primary);
    }

    .div-edit-delete .btn {
        opacity: .2;
        transition: opacity .2s ease-in-out;
    }

    .div-edit-delete:hover .btn {
        opacity: 1;
    }

    .div-edit-delete .icon {
        font-size: 2em;
    }
</style>


<div>
    <div>

        <!-- Filters - Start -->
        <div style="padding-left: 1rem;">
            <form method="get" action="" id="_form" style="display: flex;align-items:center;margin-bottom:1rem">
                <div style="white-space: nowrap;">
                    <b>Sort by :</b> &nbsp;
                    <select class="ctrl field-font" style="width: 65%;" name="sort" onchange="_form.submit()" required>
                        <option <?=$filter["sort"] == 'heading' ? 'selected' : '' ?> value='heading'>Event Name</option>
                        <option <?=$filter["sort"] == 'created_time' ? 'selected' : '' ?> value='created_time'>Date Published</option>
                    </select>
                </div> &nbsp;
                <div style="white-space: nowrap;">
                    <input class="ctrl-radio" type="radio" <?=$filter["order"] == 'asc' ? 'checked' : '' ?>  onchange="_form.submit()"  name="order" value="asc" /> Asc
                    <input class="ctrl-radio" type="radio" <?=$filter["order"] == 'desc' ? 'checked' : '' ?>  onchange="_form.submit()"  name="order" value="desc" /> Desc
                </div>
            </form>
        </div>
        <!-- Filters - End -->
        <div class="overflow-auto" style="height: calc(100vh - 200px)">
            <table class="table">
                <?php foreach ($org_news_events as $org_news_event) { ?>
                    <tr>
                        <td>
                            <div class="" style="position: relative; justify-items:center; align-items:center; display:flex;">
                                <div class="mouse-over-div div-size" style="left: 0px;">
                                    <h2 class="center" style="margin: 0;"><?= $org_news_event["heading"] ?></h2>
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="event-content"><img class="event-image" src="<?= str_replace("[\"", "", str_replace(" ", "/", str_replace("\"]", "", $org_news_event['photos']))) ?>"></div>
                                            </td>
                                            <td>
                                                <div class="event-content">
                                                    <p><?= $org_news_event["description"] ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <p style="position: absolute; color: #aaa6a1; bottom: 0px;font-size:0.8rem;">Published On : <?= $org_news_event["created_time"] ?></p>
                                </div>

                                <div class="div-edit-delete" style="justify-items:center; align-items:center; display:flex;">
                                    <div>
                                        <div>
                                            <button onclick="showModel('popupModal-edit<?= $org_news_event["item_id"] ?>')" class="btn btn-link btn-icon"><i class="fas fa-pen"></i></button>
                                            <div id="popupModal-edit<?= $org_news_event["item_id"] ?>" class="modal overflow-auto">
                                                <div class="update-form">
                                                    <span class="close" onclick="hideModel('popupModal-edit<?= $org_news_event["item_id"] ?>')">&times;</span>
                                                    <h3 class='mt1 txt-clr'>Update News / Event</h3>
                                                    <form action="/OrgManagement/update_news_event" method="post" enctype="multipart/form-data">
                                                        <div class="field">
                                                            <label for='name'>Update Event Name</label>
                                                            <input class="ctrl field-font" type="text" name="heading" value="<?= $org_news_event["heading"] ?>" required />
                                                            <input type="hidden" name="item_id" value="<?= $org_news_event["item_id"] ?>" />
                                                        </div>
                                                        <div class="field">
                                                            <div>
                                                                <label for='description'>Description</label>
                                                                <textarea rows="6" class="ctrl field-font" name="description" required><?= $org_news_event["description"] ?> </textarea>
                                                            </div>
                                                            <div>
                                                                <span class="field-msg">Update Description</span>
                                                            </div>
                                                        </div>

                                                        <div class="field ">
                                                            <label>Update Photo</label>
                                                            <div class="ctrl-group">
                                                                <span class="ctrl static"><i class="fa fa-photo-video"></i></span>
                                                                <input type="file" name="photo" class="ctrl" required accept="image/*">
                                                            </div>
                                                            <span class="field-msg">Upload a photo of the event to replace</span>
                                                        </div>
                                                        <br>
                                                        <br>

                                                        <button class='btn mr2' type='reset'>Clear</button>
                                                        <button class='btn mr2' type="submit">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <button onclick="showModel('popupModal-delete<?= $org_news_event["item_id"] ?>')" class="btn btn-link btn-icon red"><i class="fas fa-trash-alt"></i></button>
                                            <div id="popupModal-delete<?= $org_news_event["item_id"] ?>" class="modal">
                                                <div class="modal-content" style="height: 150px; width: 250px; top: 40%; left: 45%">
                                                    <span class="close" onclick="hideModel('popupModal-delete<?= $org_news_event["item_id"] ?>')">&times;</span>
                                                    <h3 style="text-align: center;">Are you sure you want to delete event?</h3>
                                                    <a href="/OrgManagement/delete_news_event?item_id=<?= $org_news_event["item_id"] ?>" class="btn red" style="position: absolute; right: 40px; bottom: 25px; width: 80px">Yes</a>
                                                    <a class="btn" style="position: absolute; left: 40px; bottom: 25px; width: 80px; background-color: var(--gray-5); border-color: var(--gray-5);" onclick="hideModel('popupModal-delete<?= $org_news_event["item_id"] ?>')">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                        </td>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </div>

</div>
<div style="position:fixed;right:20px;bottom:20px;  padding-bottom: 0px"><a href="/OrgManagement/add_new_event" class="btn right outline button-hover" style="width: 60px; height:60px; border-radius: 5rem; box-shadow: var(--shadow);" title="Add New Event"><i class="fas fa-plus"></i></a></div>

<script>
    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(event) {
            if (event.target.classList.contains('modal') && !event.target.classList.contains('modal-content')) {
                let model = document.querySelector('.modal.shown');
                model.style.display = "none"
                model.classList.remove("shown")
                document.getElementById(id).onclick = null
            }
        }
    }

    function hideModel(id) {
        document.getElementById(id).classList.remove("shown")
        document.getElementById(id).style.display = "none";
        document.getElementById(id).onclick = null
    }
</script>