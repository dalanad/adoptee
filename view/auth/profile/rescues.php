<style>
    th {
        width: 5rem;
    }

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
</style>

<h3 style="margin-left:1rem;">My Rescues</h3>
<div class="overflow-auto" style="height:450px"><?php //print_r($rescues) ?>
    <table class="table">
        <tr>
            <th></th>
            <th>TYPE</th>
            <th>LOCATION</th> <!-- remove and put into model-->
            <th>REPORTED DATE</th>
            <th>RESCUED DATE</th>
            <th>STATUS</th>
            <th>RESPONDED ORGANIZATION</th>
        </tr>

        <?php foreach ($rescues as $key => $value) { ?>
            <tr style="font-size: 0.8rem;">
                <td>
                    <img src="<?= json_decode($value['photos'])[0] ?>" style="width: 40px; height: 40px; border-radius: 50%;">
                </td>
                </td>
                <td><?= $value["type"] ?></td>
                <td><?= $value["location"] ?></td>
                <td><?= substr($value["time_reported"], 0, 10) ?></td>
                <td><?= $value["status"] == "RESCUED" ? substr($value["rescued_date"],0,10) : "" ?></td>
                <td><span class="tag <?= $value["status"] == "RESCUED" ? 'green' : 'orange' ?>"><?= $value["status"] ?> </span></td>
                <td><?= $value["status"] == "RESCUED" ? ($value["o_name"]) : "" ?></td>
                <!-- <td>
                    <div class="btn btn-link" onclick="showModel('progressModel?= $value['animal_id'] ?>')" title="View"><i class="far fa-eye"></i></div>
                    <div class="model" id="progressModel?= $value['animal_id'] ?>">
                        <div class="model-content">
                            <span class="close" onclick="hideModel('progressModel?= $value['animal_id'] ?>')">&times;</span>
                            <table class="table">
                                <tr>
                                    <th>DATE</th>
                                    <th>DESCRIPTION</th>
                                    <th>PHOTOS</th>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                </tr>
                            </div>
                        </div>
                    </div>
                </td> -->
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