<style>
    .model {
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

    .model-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        padding: 20px;
        border: 1px solid #888;
        position: fixed;
        top: 40%;
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

    th {
        font-weight: bold;
    }

    .unsubscribe {
        background: #bbbaba;
        border: none;
    }
</style>

<?php
$durations = [
    "7" => "Weekly",
    "30" => "Monthly",
    "180" => "Bi-Annual",
    "365" => "Annual"
];
?>

<div class="overflow-auto" style="height:450px">
    <table class="table">
        <tr>
            <th>TIER</th>
            <th>AMOUNT</th>
            <th>RECURRING DAYS</th>
            <th>DESCRIPTION</th>
        </tr>
        <?php foreach ($tiers as $key => $value) { ?>
            <tr>
                <td><?= $value['name'] ?></td>
                <td>Rs.<?= $value['amount'] ?></td>
                <td><?= $durations[$value['recurring_days']] ?></td>
                <td><?= $value['description'] ?></td>
                <td>
                    <?php if (sizeof($sponsorships) == 0) { ?>
                        <div onclick="showModel('popupmodel-subscribe<?= $value['name'] ?>')" class=" btn pink" style='margin-left :20px;'>Subscribe</div>
                        <div id="popupmodel-subscribe<?= $value['name'] ?>" class="model">
                            <form id="subscribe_form<?= $value['name'] ?>" action="/Organization/subscribe" method="post" class="model-content" style="width:20rem;text-align:center;">
                                <span class="close" onclick="hideModel('popupmodel-subscribe<?= $value['name'] ?>')">&times;</span>
                                <h3>Are you sure you want to subscribe to this sponsorship?</h3>
                                <p>You can opt out at any time.</p>
                                <div style="display:flex;justify-content:center;">
                                    <button type="submit" class="btn btn-faded green mr2">Subscribe</button>
                                    <input type="text" name="tier" value="<?= $value['name'] ?>" style="display:none;" />
                                    <input type="text" name="org" value="<?= $_GET['org_id'] ?>" style="display:none;" />
                                    <button type="button" class="btn btn-faded blue" onclick="hideModel('popupmodel-subscribe<?= $value['name'] ?>')">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <?php } else foreach ($sponsorships as $sponsorship => $val) {
                        if ($val['name'] == $value['name']) { ?>
                            <!--User is already sponsoring the org-->
                            <div onclick="showModel('popupmodel-unsubscribe<?= $value['name'] ?>')" class=" btn unsubscribe" style='margin-left :20px;'>Unsubscribe</div>
                            <div id="popupmodel-unsubscribe<?= $value['name'] ?>" class="model">
                                <form id="unsubscribe_form<?= $value['name'] ?>" action="/Organization/unsubscribe" method="post" class="model-content" style="width:20rem;text-align:center;">
                                    <span class="close" onclick="hideModel('popupmodel-unsubscribe<?= $value['name'] ?>')">&times;</span>
                                    <h3>Are you sure you want to unsubscribe from this sponsorship?</h3>
                                    <div style="display:flex;justify-content:center;">
                                        <button type="submit" class="btn btn-faded red mr2">Unsubscribe</button>
                                        <input type="text" name="tier" value="<?= $value['name'] ?>" style="display:none;" />
                                        <input type="text" name="org" value="<?= $_GET['org_id'] ?>" style="display:none;" />
                                        <button type="button" class="btn btn-faded blue" onclick="hideModel('popupmodel-unsubscribe<?= $value['name'] ?>')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        <?php
                        } else { ?>
                            <div onclick="showModel('popupmodel-subscribe<?= $value['name'] ?>')" class=" btn pink" style='margin-left :20px;'>Subscribe</div>
                            <div id="popupmodel-subscribe<?= $value['name'] ?>" class="model">
                                <form id="subscribe_form<?= $value['name'] ?>" action="/Organization/subscribe" method="post" class="model-content" style="width:20rem;text-align:center;">
                                    <span class="close" onclick="hideModel('popupmodel-subscribe<?= $value['name'] ?>')">&times;</span>
                                    <h3>Are you sure you want to subscribe to this sponsorship?</h3>
                                    <p>You can opt out at any time.</p>
                                    <div style="display:flex;justify-content:center;">
                                        <button type="submit" class="btn btn-faded green mr2">Subscribe</button>
                                        <input type="text" name="tier" value="<?= $value['name'] ?>" style="display:none;" />
                                        <input type="text" name="org" value="<?= $_GET['org_id'] ?>" style="display:none;" />
                                        <button type="button" class="btn btn-faded blue" onclick="hideModel('popupmodel-subscribe<?= $value['name'] ?>')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                    <?php }
                    } ?>
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
            if (event.target.classList.contains('model') && !event.target.classList.contains('model-content')) {
                let model = document.querySelector('.model.shown');
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

    // function change(_this) {
    //     if (_this.innerHTML == 'Subscribe') {
    //         _this.style.backgroundColor = "#bbbaba";
    //         _this.style.borderColor = '#ffffff';
    //         _this.innerHTML = 'Unsubscribe';
    //     } else {
    //         _this.style.backgroundColor = "#ff1493";
    //         _this.style.borderColor = '#ffffff';
    //         _this.innerHTML = 'Subscribe';
    //     }

    // }
</script>