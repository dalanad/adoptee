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
        flex: 20%;
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

    .div-size {
        width: 100px;
        height: 100px;
        min-height: 3rem;
        margin-bottom: 1em;
    }

    .button-hover:hover {
        background-color: var(--primary);
        color: white;
        transition: opacity 0.2s ease-in;
    }

    .check {
        display: flex;
        flex-wrap: wrap;
    }

    .check input {
        display: none;
    }

    .check label {
        padding: 1rem;
        border: 2px solid var(--gray-3);
        display: block;
        border-radius: 50%;
        cursor: pointer;
        margin-right: .3rem;
        text-align: center;
        margin-bottom: .3rem;
    }

    .check input:checked+label {
        opacity: 0.5;
        border-color: var(--primary);
    }
</style>




<div style="padding-top: 2.5rem;">



    <!-- Filters - Start -->
    <div style="padding-left: 1rem;">
        <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
            <div>
                <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="">
                <button class="btn outline button-hover">Search</button>
            </div> &nbsp; | &nbsp;
            <div style="white-space: nowrap;">
                <b>View :</b> &nbsp;
                <input class="ctrl-radio" type="radio" onchange="" name="status" value="Listed" /> Listed
                <input class="ctrl-radio" type="radio" onchange="" name="status" value="Adopted" /> Adopted
                <input class="ctrl-radio" type="radio" onchange="" name="status" value="Deleted" /> Deleted
                <input class="ctrl-radio" type="radio" onchange="" name="status" value="Any" /> Any
            </div> &nbsp; | &nbsp;
            <div style="white-space: nowrap;">
                <b>Sort by :</b> &nbsp;
                <select class="ctrl field-font" style="width: 65%;" required>
                    <option selected='true' disabled='disabled'>- Select -</option>
                    <option value='name'>Adoptee Name</option>
                    <option value='type'>Adoptee Type</option>
                    <option value='gender'>Gender</option>
                    <option value='age'>Age</option>
                </select>
            </div> &nbsp;
            <div style="white-space: nowrap;">
                <input class="ctrl-radio" type="radio" onchange="" name="order" value="asc" /> Asc
                <input class="ctrl-radio" type="radio" onchange="" name="order" value="desc" /> Desc
            </div>
        </form>
    </div>
    <!-- Filters - End -->
    <div class="overflow-auto" style="height: 500px;">
        <table class="table">
            <tr>
                <th>animal</th>
                <th>TYPE</th>
                <th>AGE</th>
                <th>DATE LISTED</th>
                <th>STATUS</th>
                <th>DATE ADOPTED</th>
                <th>INFO</th>
                <th></th>
            </tr>
            <br>

            <?php foreach ($animals as $animal) { ?>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td><img src="<?= $animal["avatar_photo"] ?>" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                                <td>
                                    <div>
                                        <div style="padding: 3px;"><?= $animal["name"] ?></div>
                                        <div style="padding: 3px;"><i class="txt-clr fa fa-lg fa-<?= $animal['gender'] == "MALE" ? 'mars blue' : 'venus pink' ?>"></i></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td><?= $animal["type"] ?></td>
                    <td><?= $animal["age"] ?> years</td>
                    <td><?= $animal["date_listed"] ?></td>
                    <td><span class="tag <?= $animal["status"] == "ADOPTED" ? 'green' : 'pink' ?>"> <?= $animal["status"] ?> </span></td>
                    <td><?= $animal["date_adopted"] ?></td>
                    <td>
                        <button onclick="showModel('popupModal-1<?= $animal["animal_id"] ?>')" title="More Details" class="btn btn-link">Details</button>
                        <div id="popupModal-1<?= $animal["animal_id"] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="hideModel('popupModal-1<?= $animal["animal_id"] ?>')">&times;</span>
                                <h3>Description</h3>
                                <?= $animal["description"] ?>
                            </div>

                        </div>
                    </td>

                    <td>
                        <div style="display: flex;">
                            <div><button onclick="showModel('popupModal-2<?= $animal["animal_id"] ?>')" title="Update Details" class="btn btn-link btn-icon"><i class="<?= $animal["status"] == "LISTED" ? 'fas fa-pen' : '' ?>"></i></button></div>
                            <div id="popupModal-2<?= $animal["animal_id"] ?>" class="modal overflow-auto">
                                <div class="update-form">
                                    <span class="close" onclick="hideModel('popupModal-2<?= $animal["animal_id"] ?>')">&times;</span>
                                    <h3 class='mt1 txt-clr'>Update Adoptee Details</h3>

                                    <form action="/OrgManagement/edit_animal_for_adoption" method="post">

                                        <div class="row">
                                            <div class='field column'>
                                                <label for='status'>Adoption Status</label>
                                                <input class="ctrl field-font" type="text" name="status" value="<?= $animal["status"] ?>" readonly />
                                            </div>
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
                                            <!-- start of column 1-->
                                            <div class='field column' style="margin-right: 0rem;">
                                                <!-- row 1-->
                                                <div class="row">
                                                    <div class='field column'>
                                                        <label for='dob'>Approximate DOB</label>
                                                        <div>
                                                            <input class="ctrl2 field-font" type="date" name="dob" id="datefield" value="<?= $animal["dob"] ?>" required />
                                                            <p id="result"></p>
                                                        </div>
                                                    </div>


                                                    <div class='field column' style="margin-right: 0rem;">
                                                        <div class='field'>
                                                            <label for="color"> Color </label>
                                                            <div class="check">
                                                                <input id="white" name="color[]" type="checkbox" value="White" <?= in_array('White', $animal['color']) ? "checked" : ""; ?>>
                                                                <label for="white" style="background:cornsilk;" title="White"></label>
                                                                <input id="grey" name="color[]" type="checkbox" value="Grey" <?= in_array('Grey', $animal['color']) ? "checked" : ""; ?>>
                                                                <label for="grey" style="background:grey;" title="Grey"></label>
                                                                <input id="orange" name="color[]" type="checkbox" value="Orange" <?= in_array('Orange', $animal['color']) ? "checked" : ""; ?>>
                                                                <label for="orange" style="background:darkgoldenrod;" title="Orange"></label>
                                                                <input id="brown" name="color[]" type="checkbox" value="Brown" <?= in_array('Brown', $animal['color']) ? "checked" : ""; ?>>
                                                                <label for="brown" style="background:brown;" title="Brown"></label>
                                                                <input id="black" name="color[]" type="checkbox" value="Black" <?= in_array('Black', $animal['color']) ? "checked" : ""; ?>>
                                                                <label for="black" style="background:black;color:white;" title="Black"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- row 2-->
                                                <div class="row">
                                                    <div class="field column style=" margin-right: 0rem;">
                                                        <label>Description</label>
                                                        <textarea rows="6" class="ctrl field-font" name="description"><?= $animal["description"] ?></textarea>
                                                        <span class="field-msg"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of column 1-->

                                            <!-- start of column 2-->
                                            <div class="field column">
                                                <div class="row">
                                                    <div class="field column">
                                                        <label style="margin-top: 1rem; margin-bottom: 1rem;">Initial Vaccine</label>

                                                        <div style="margin: 0.5rem;">
                                                            <label for='anti_rabies'>Anti Rabies</label>
                                                            <div><input class="ctrl2" type="date" name="anti_rabies" max="" id="datefield" value="<?= $animal["anti_rabies"] ?>"></div>
                                                        </div>
                                                        <div class="Dog box" style="margin: 0.5rem;">
                                                            <label for='dhl'>DHL</label>
                                                            <div><input class="ctrl2" type="date" name="dhl" max="" id="datefield" value="<?= $animal["dhl"] ?>"></div>
                                                        </div>
                                                        <div style="margin: 0.5rem;">
                                                            <label for='parvo'>Parvo</label>
                                                            <div><input class="ctrl2" type="date" name="parvo" max="" id="datefield" value="<?= $animal["parvo"] ?>"></div>
                                                        </div>
                                                        <div class="Cat box" style="margin: 0.5rem;">
                                                            <label for='tricat'>Tricat</label>
                                                            <div><input class="ctrl2" type="date" name="tricat" max="" id="datefield" value="<?= $animal["tricat"] ?>"></div>
                                                        </div>
                                                        <div>
                                                            <span class="field-msg">Select date only if vaccinated</span>

                                                        </div>
                                                    </div>
                                                    <div class="field column">
                                                        <label style="margin-top: 1rem; margin-bottom: 1rem;">Yearly Booster</label>

                                                        <div style="margin: 0.5rem;">
                                                            <label for='anti_rabies_booster'>Anti Rabies Booster</label>
                                                            <div><input class="ctrl2" type="date" name="anti_rabies_booster" max="" id="datefield" value="<?= $animal["anti_rabies_booster"] ?>"></div>
                                                        </div>
                                                        <div class="Dog box" style="margin: 0.5rem;">
                                                            <label for='dhl_booster'>DHL Booster</label>
                                                            <div><input class="ctrl2" type="date" name="dhl_booster" max="" id="datefield" value="<?= $animal["dhl_booster"] ?>"></div>
                                                        </div>
                                                        <div style="margin: 0.5rem;">
                                                            <label for='parvo_booster'>Parvo Booster</label>
                                                            <div><input class="ctrl2" type="date" name="parvo_booster" max="" id="datefield" value="<?= $animal["anti_rabies"] ?>"></div>
                                                        </div>
                                                        <div class="Cat box" style="margin: 0.5rem;">
                                                            <label for='tricat_booster'>Tricat Booster</label>
                                                            <div><input class="ctrl2" type="date" name="tricat_booster" max="" id="datefield" value="<?= $animal["tricat_booster"] ?>"></div>
                                                        </div>
                                                        <div>
                                                            <span class="field-msg">Select date only if vaccinated this year</span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='field column'>
                                                    <div>
                                                        <label for='dewormed'>Dewormed</label>
                                                        <div><input class="ctrl2" type="date" name="dewormed" max="" id="datefield" value="<?= $animal["dewormed"] ?>"></div>
                                                    </div>
                                                    <div>
                                                        <span class="field-msg">Select date only if dewormed within the past 6 months</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of column 2-->
                                        </div>



                                        <div class="field column">
                                            <div class="preview" style="background-image: url(<?= $animal['photo'] ?>);"> </div>
                                            <div class="thumbnails">
                                                <div class="thumbnail" style="background-image: url(<?= $animal['photo'] ?>);cursor:pointer;" onclick="displayPreview(this)"> </div>
                                                <?php
                                                $photos = explode(",", $animal['photos']);
                                                for ($i = 0; $i < sizeof($photos); $i++) { ?>
                                                    <div class="thumbnail" style="background-image: url(../../..<?= str_replace("[", "", str_replace("\"", "", str_replace(" ", "/", str_replace("]", "", $photos[$i])))) ?>);cursor:pointer;" onclick="displayPreview(this)"> </div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        <br>

                                        <button class='btn mr2' type='reset'>Discard Changes</button>
                                        <button class='btn mr2' type="submit">Update</button>
                                    </form>

                                </div>

                            </div>&nbsp;
                            <div>
                                <button onclick="showModel('popupModal-delete<?= $animal["animal_id"] ?>')" class="btn btn-link btn-icon red"><i class="<?= $animal["status"] == "LISTED" ? 'fas fa-trash-alt' : '' ?>"></i></button>
                                <div id="popupModal-delete<?= $animal["animal_id"] ?>" class="modal">
                                    <div class="modal-content" style="height: 150px; width: 250px; top: 40%; left: 50%">
                                        <span class="close" onclick="hideModel('popupModal-delete<?= $animal["animal_id"] ?>')">&times;</span>
                                        <h3 style="text-align: center;">Are you sure you want to delete record?</h3>
                                        <a href="/OrgManagement/delete_animal?animal_id=<?= $animal["animal_id"] ?>" class="btn red" style="position: absolute; right: 40px; bottom: 25px; width: 80px">Yes</a>
                                        <a class="btn" style="position: absolute; left: 40px; bottom: 25px; width: 80px; background-color: var(--gray-5); border-color: var(--gray-5);" onclick="hideModel('popupModal-delete<?= $animal["animal_id"] ?>')">Cancel</a>
                                    </div>
                                </div>
                            <div>
                    </td>
                </tr>

            <?php } ?>

        </table>
    </div>
</div>
<div style="margin-left: 1200px; padding-bottom: 0px"><a href="/OrgManagement/add_new_animal" class="btn right outline button-hover" style="width: 60px; height:60px; border-radius: 5rem; box-shadow: var(--shadow);" title="Add New Animal"><i class="fas fa-plus"></i></a></div>

<script>
    function displayPreview(_this) {
        var prev = document.getElementsByClassName('preview')[0];
        var thumb = _this.style.backgroundImage;
        prev.style.backgroundImage = thumb;
    }

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

    //Max Date input
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("max", today);
</script>