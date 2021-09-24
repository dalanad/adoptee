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

    .row {
        display: flex;
    }

    .column {
        margin-right: 1rem;
        flex: 30%;
    }

    .ctrl2 {
        padding: 0.4em 0.5em;
        line-height: 1;
        border-radius: 8px;
        font-family: inherit;
        color: var(--color);
        font-size: 1rem;
        border: 0.1rem solid var(--muted);
        background: var(--gray-1);
        width: 50%;
        box-sizing: border-box;
    }
</style>




<div class="container" style="top: 100px">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        ADOPTEE
        <a href="/OrgManagement/add_new_animal" class="btn right outline"> Add New Animal </a>
    </h3>
    <div class=" overflow-auto" style="height:550px">
            <table class="table">
                <tr>
                    <th>PET</th>
                    <th>TYPE</th>
                    <th>AGE</th>
                    <th>GENDER</th>
                    <th>DATE LISTED</th>
                    <th>STATUS</th>
                    <th>DATE ADOPTED</th>
                    <th>INFO</th>
                    <th></th>
                </tr>

                <?php foreach ($animals as $animal) { ?>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td><img src="<?= $animal["photo"] ?>" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                                    <td><?= $animal["name"] ?></td>
                                </tr>
                            </table>
                        </td>
                        <td><?= $animal["type"] ?></td>
                        <td><?= $animal["dob"] ?></td>
                        <td><?= $animal["gender"] ?></td>
                        <td><?= $animal["date_listed"] ?></td>
                        <td><span class="tag <?= $animal["status"] == "ADOPTED" ? 'green' : 'pink' ?>"> <?= $animal["status"] ?> </span></td>
                        <td><?= $animal["date_adopted"] ?></td>
                        <td>
                            <button onclick="showModel('popupModal-1<?= $animal["animal_id"] ?>')" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                            <div id="popupModal-1<?= $animal["animal_id"] ?>" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="hideModel('popupModal-1<?= $animal["animal_id"] ?>')">&times;</span>
                                    <h3>Description</h3>
                                    <?= $animal["description"] ?>
                                </div>

                            </div>
                        </td>

                        <td>
                            <button onclick="showModel('popupModal-2<?= $animal["animal_id"] ?>')" title="Update Details" class="btn btn-link btn-icon"><i class="fas fa-pen"></i></button>
                            <div id="popupModal-2<?= $animal["animal_id"] ?>" class="modal">
                                <div class="update-form">
                                    <span class="close" onclick="hideModel('popupModal-2<?= $animal["animal_id"] ?>')">&times;</span>
                                    <h3 class='mt1 txt-clr'>Update Adoptee Details</h3>

                                    <form action="/OrgManagement/process_edit_animal_for_adoption" method="post">
                                    
                                    <div class="row">
                                        <div class='field column'>
                                            <label for='status'>Adoption Status</label>
                                            <select class="ctrl field-font" name='status' required>
                                                <option selected='true' disabled='disabled'><?= $animal["status"] ?></option>
                                                <option value='adopted'>Adopted</option>
                                                <option value='listed'>Listed</option>
                                            </select>
                                        </div>
                                        <div class='column'></div>
                                        <div class='column'></div>
                                    </div>

                                        <div class="row">
                                            <div class='field column'>
                                                <label for='name'>Name</label>
                                                <input class="ctrl field-font" type="text" name="name" value="<?= $animal["name"] ?>" required />
                                            </div>

                                            <div class='field column'>
                                                <label for='type'>Type</label>
                                                <select class="ctrl field-font" name='type' required>
                                                    <option selected='true' disabled='disabled'><?= $animal["type"] ?></option>
                                                    <option value='dog'>Dog</option>
                                                    <option value='cat'>Cat</option>
                                                    <option value='other'>Other</option>
                                                </select>
                                            </div>

                                            <div class='field column'>
                                                <label for='gender'>Gender</label>
                                                <select class="ctrl field-font" name='gender' required>
                                                    <option selected='true' disabled='disabled'><?= $animal["gender"] ?></option>
                                                    <option value='male'>Male</option>
                                                    <option value='female'>Female</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class='column'></div>
                                            <div class='field other box column'>
                                                <label for='type'>Other</label>
                                                <input class="ctrl field-font" type="text" name="other" value="<?= $animal["other"] ?>" />
                                            </div>
                                            <div class='column'></div>
                                        </div>

                                        <div class="row">
                                            <div class='field column'>
                                                <label for='dob'>Approximate DOB</label>
                                                <div>
                                                    <input style="width: 100%" class="ctrl2 field-font" type="date" name="dob" id="dob" value="<?= $animal["dob"] ?>" required />
                                                    <p id="result"></p>
                                                </div>
                                            </div>

                                            
                                        <div class='field column'>
                                            <label for='color'>Color</label>
                                            <input class="ctrl field-font" type="text" name="color" value="<?= $animal["color"] ?>" required />
                                        </div>

                                        </div>


                                        <div class="field">
                                            <label>Description</label>
                                            <textarea rows="6" class="ctrl field-font" name="description" value="<?= $animal["description"] ?>"></textarea>
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

                                        <button class='btn mr2' type='reset'>Discard Changes</button>
                                        <button class='btn mr2' type="submit">Update</button>
                                    </form>

                                </div>

                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </table>
</div>
</div>

<script>
    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(event) {
            if (event.target.classList.contains('modal') && !event.target.classList.contains('modal-content' || 'update-form')) {
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

    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".box").hide();
                }
            });
        }).change();
    });
</script>