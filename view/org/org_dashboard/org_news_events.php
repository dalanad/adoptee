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
        padding: 20px;
        border: 1px solid #888;
        width: 25%;
        position: fixed;
        top: 40%;
        left: 35%;

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
        border: 3px solid var(--gray-3);
        margin-bottom: 2rem;
        object-fit: cover;
        width: 380px;
        height: 200px;
        border-radius: 0.5rem;
    }

    .div-size {
        width: 1150px;
        height: 400px;
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


<div style="padding-top: 0.5rem;">
    <div style="height: 555px; padding-top: 2rem;">

        <!-- Filters - Start -->
        <div style="padding-left: 1rem;">
            <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
                <div>
                    <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="">
                    <button class="btn outline button-hover">Search</button>
                </div> &nbsp; | &nbsp;
                <div style="white-space: nowrap;">
                    <b>Sort by :</b> &nbsp;
                    <select class="ctrl field-font" style="width: 65%;" required>
                        <option selected='true' disabled='disabled'>- Select -</option>
                        <option value='name'>Event Name</option>
                        <option value='date'>Date Published</option>
                    </select>
                </div> &nbsp;
                <div style="white-space: nowrap;">
                    <input class="ctrl-radio" type="radio" onchange="" name="order" value="asc" /> Asc
                    <input class="ctrl-radio" type="radio" onchange="" name="order" value="desc" /> Desc
                </div>
            </form>
        </div>
        <!-- Filters - End -->
        <div class="overflow-auto" style="height: 480px;">
        <table class="table">
        <?php foreach ($org_news_events as $org_news_event) { ?>
            <tr>
                <td>
                    <div class="" style="position: relative; justify-items:center; align-items:center; display:flex;">
                        <div class="mouse-over-div div-size" style="left: 0px;">
                            <h2 class="center"><?= $org_news_event["heading"] ?></h2>
                            <table>
                                <tr>
                                    <td>
                            <div class="event-content"><img class="event-image" src="<?= str_replace("[\"","",str_replace(" ","/",str_replace("\"]","",$org_news_event['photos'])))?>"></div>
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
                                <div><button onclick="showModel('popupModal-delete<?= $org_news_event["item_id"] ?>')" class="btn btn-link btn-icon"><i class="fas fa-pen"></i></button></div>
                                <button onclick="showModel('popupModal-delete<?= $org_news_event["item_id"] ?>')" class="btn btn-link btn-icon red"><i class="fas fa-trash-alt"></i></button>
                                <div id="popupModal-delete<?= $org_news_event["item_id"] ?>" class="modal">
                                    <div class="modal-content" style="height: 150px; width: 250px; top: 40%; left: 45%">
                                        <span class="close" onclick="hideModel('popupModal-delete<?= $org_news_event["item_id"] ?>')">&times;</span>
                                        <h3 style="text-align: center;">Are you sure you want to delete event?</h3>
                                        <a href="/OrgManagement/delete_animal?item_id=<?= $org_news_event["item_id"] ?>" class="btn red" style="position: absolute; right: 40px; bottom: 25px; width: 80px">Yes</a>
                                        <a class="btn" style="position: absolute; left: 40px; bottom: 25px; width: 80px; background-color: var(--gray-5); border-color: var(--gray-5);" onclick="hideModel('popupModal-delete<?= $org_news_event["item_id"] ?>')">Cancel</a>
                                    </div>
                                </div>
                                <div>
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
<div style="margin-left: 1200px; padding-bottom: 0px"><a href="/OrgManagement/add_new_event" class="btn right outline button-hover" style="width: 60px; height:60px; border-radius: 5rem; box-shadow: var(--shadow);" title="Add New Event"><i class="fas fa-plus"></i></a></div>

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