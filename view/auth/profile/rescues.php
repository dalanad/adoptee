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
        top: 25%;
        left: 25%;
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

    .row {
        display: flex;
        margin-bottom: 2rem;
    }

    .column {
        /* margin-right: 1rem; */
        flex: 50%;
    }
</style>

<h3 style="margin:0rem;">My Rescues</h3>
<div class="overflow-auto" style="height:450px">
    <table class="table">
        <tr>
            <th style="width:3rem;"></th>
            <th style="width:3rem;">TYPE</th>
            <th>LOCATION</th>
            <th>REPORTED DATE</th>
            <th style="text-align:center;">STATUS</th>
            <th style="width:1.5rem;"></th>
        </tr>

        <?php foreach ($rescues as $key => $value) { ?>
            <tr>
                <td>
                    <img src="<?= json_decode($value['photos'])[0] ?>" style="width: 40px; height: 40px; border-radius: 50%;">
                </td>
                <td><?= $value["type"] ?></td>
                <td><?= $value["location"] ?></td>
                <td><?= substr($value["time_reported"], 0, 10) ?></td>
                <td style="text-align:center;"><span class="tag <?= $value["status"] == "RESCUED" ? 'green' : 'orange' ?>"><?= $value["status"] ?> </span></td>
                <td>
                    <div class="btn btn-link" onclick="showModel('progressModel<?= $value['report_id'] ?>')" title="View"><i class="far fa-eye"></i></div>
                    <div class="model" id="progressModel<?= $value['report_id'] ?>">
                        <div class="model-content" style="width:fit-content;height:fit-content;top:10%;left:25%;">
                            <span class="close" onclick="hideModel('progressModel<?= $value['report_id'] ?>')">&times;</span>

                            <div class="row" style="margin-top: 2rem;">
                                <div class="column"><b>Rescued Date:</b></div>
                                <div class="column"><?= $value["status"] == "RESCUED" ? substr($value["rescued_date"], 0, 10) : "" ?></div>
                            </div>
                            <div class="row">
                                <div class="column"><b>Responded Organization:</b></div>
                                <div class="column"><?= $value["status"] == "RESCUED" ? ($value["o_name"]) : "" ?></div>
                            </div>
                            <div class="row">
                                <div class="column"><b>Progress:</b></div>
                                <div class="column">
                                    <b><?= $value["status"] == "RESCUED" ? $value['heading'] : "-" ?> </b></br></br>
                                    <p><?= $value["status"] == "RESCUED" ? $value['description'] : "-" ?></p>
                                    <?php if ($value["status"] == "RESCUED") { ?>
                                        <div><img src="/<?= $value['photo'] ?>" style="width:20rem;height:auto;border-radius:4px"></div>
                                        <span class="field-msg"><?= explode(" ", $value['time_updated'])[0] ?></span>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
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

    function newPet() {

    }
</script>