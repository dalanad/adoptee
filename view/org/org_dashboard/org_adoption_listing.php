<style>
    .pop-up {
        position: absolute;
        width: 350px;
        height: 250px;
        top: 10px;
        left: 10px;
        background: white;
        box-shadow: var(--shadow);
        z-index: 100;
        border-radius: 0.5rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
</style>



<div class="container">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        ADOPTEES
        <a href="./add_new_animal"><button class="btn right">Add New Animal</button></a>
    </h3>
    <div class="overflow-auto" style="height:450px">
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
                <tr style="font-size: 0.8rem;">
                    <td><?= $animal["name"] ?></td>
                    <td><?= $animal["type"] ?></td>
                    <td><?= $animal["dob"] ?></td>
                    <td><?= $animal["gender"] ?></td>
                    <td><?= $animal["date_listed"] ?></td>
                    <td><span class="tag <?= $animal["status"] == "ADOPTED" ? 'green' : 'pink' ?>"> <?= $animal["status"] ?> </span></td>
                    <td><?= $animal["date_adopted"] ?></td>
                    <td>
                        <button title="More Details" class="btn btn-link btn-icon" href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop">
                            <div data-role="popup" id="popupDialog" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
                                <div data-role="header" data-theme="a">
                                    <i class="fas fa-info-circle"></i>

                                </div>
                                <div class="cases_list">
                                    <div style="height:240px; overflow-x:hidden; overflow-y: auto;">
                                        <table class="table" style="text-align: center;">
                                            <tr>
                                                <th style="font-size: 0.6rem;">TYPE</th>
                                                <th style="font-size: 0.6rem;">INFO</th>
                                                <th style="font-size: 0.6rem;">CONTACT</th>
                                                <th style="font-size: 0.6rem;">PHOTO</th>
                                                <th style="font-size: 0.6rem;">LOCATION</th>
                                                <th style="font-size: 0.6rem;">RESCUE</th>
                                            </tr>
                                            <tr style="font-size: 0.6rem;">
                                                <td><?= $animal["description"] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </td>
                    <td><button title="Edit" class="btn btn-link btn-icon"><i class="fas fa-pen"></i></button></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>