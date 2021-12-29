<style>
    .expandable {
        background: #fff;
        overflow: hidden;
        color: #000;
        line-height: 50px;

        transition: all .5s ease-in-out;
        height: 0;
    }


    .expandable:target {
        height: 100%;
    }

    form {
        border-style: solid;
        border-right: none;
        border-left: none;
        padding: 1rem;
        border-color: var(--gray-3);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        /* margin: auto; */
        padding: 20px;
        border: 1px solid #888;
        /* width: 50%; */
        position: fixed;
        top: 20%;
        left: 31%;
        max-height: calc(100vh - 210px);
        overflow-y: auto;
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

    /* .update-table> th{
        color:var(--green);
    } */
</style>

<h3 style="margin-left:1rem;">My Adoptions</h3>
<div class="overflow-auto" style="height:450px">
    <table class="table">
        <tr>
            <th>PET</th>
            <th>ADOPTED FROM</th>
            <th>DATE ADOPTED</th>
            <th></th>
        </tr>

        <?php foreach ($adoptions as $key => $value) { ?>
        <tr style="font-size: 1rem;">
            <td>
                <table>
                    <tr>
                        <td rowspan="2"><img src="../../../<?= $value['photo'] ?>" style="width:50px;height:50px;border-radius:50%;margin-left:0px;"></td>
                        <td><?= $value["a_name"] ?></td>
                    </tr>
                    <tr>
                        <td><?= round($value["age"]) ?> Years</td>
                    </tr>
                </table>
            </td>
            <td><?= $value["o_name"] ?></td>
            <td><?= $value["date_adopted"] ?></td>
            <td>
                <?php if($value['status']=='REMOVED') { ?>
                    <div class="mt2 btn btn-faded pink removed">REMOVED</div>
                    <?php }else { ?>
                <div id="content">
                    <a class='btn btn-link green bold' href="#<?= $value["a_id"] ?>">Add Update</a>
                </div>
                <?php } ?>
            </td>
            <td>
                <!-- Past updates -->
                <span onclick="showModel('pastUpdates<?= $value['a_id'] ?>')" class="btn btn-link pink">Past Updates</span>
                <div id="pastUpdates<?= $value['a_id'] ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hideModel('pastUpdates<?= $value['a_id'] ?>')">&times;</span>
                        <table class="table update-table">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Photo</th>
                            </tr>
                            <?php foreach ($updates as $update) {
                                if ($update['animal_id'] == $value['a_id']) { ?>
                                    <tr>
                                        <td><?= $update['update_date'] ?></td>
                                        <td><?= $update['type'] ?></td>
                                        <td><?= $update['description'] ?></td>
                                        <td><img src="<?= $update['photo'] ?>" style="width:3rem;height:3rem;border-radius:4px;justify-content:center;"></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <!-- Add Update -->
            <td colspan="4">
                <div class="expandable" id="<?= $value["a_id"] ?>">
                    <form action="/Adoptions/addAdopteeUpdate" method="post" class="m2" enctype="multipart/form-data">
                        <input type="text" name="animalId" value="<?= $value["a_id"] ?>" hidden />
                        <div class="field" style="display:flex;">
                            <label for="type">Update type:</label>
                            <div class="mb2">
                                Health&nbsp<input name="type" type="radio" value="health" class="ctrl-check mr1" />
                                Nutrition&nbsp<input name="type" type="radio" value="nutrition" class="ctrl-check mr1" />
                                Other&nbsp<input name="type" type="radio" value="other" class="ctrl-check mr1" />
                            </div>
                        </div>
                        <div class="field">
                            <label for="desc">Description:</label>
                            <textarea name="desc" class="ctrl" rows="4"></textarea>
                        </div>
                        <div class="field">
                            <label for="photo">Photo:</label>
                            <input name="photo" type="file" accept="image/*" class="ctrl" />
                        </div>
                        <div style="display:flex;">
                            <button type="submit" class="btn mt2" style="height:2rem;">Send update</button>
                            <a href='' type="reset" class="btn mt2 ml2" style="height:2rem;">Cancel</a>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
    <?php } ?>
    </table>
</div>

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

    function newPet() {

    }
</script>