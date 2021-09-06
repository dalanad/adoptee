<?php

$adoption_requests = array(
    array("id" => 1, "adoptee" => "Tobi", "type" => "Dog", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => false, "r2" => false),
    array("id" => 2, "adoptee" => "Zeus", "type" => "Rabbit", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => false, "r2" => true),
    array("id" => 3, "adoptee" => "Ellie", "type" => "Cat", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => true, "r2" => true),
    array("id" => 4, "adoptee" => "Nala", "type" => "Dog", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => true, "r2" => true),
);

?>

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
</style>

<div class="container">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        ADOPTION REQUESTS
    </h3>

    <div class="overflow-auto" style="height:450px">
        <table class="table">
            <tr>
                <th>ADOPTEE ID</th>
                <th>ADOPTEE</th>
                <th>ADOPTEE TYPE</th>
                <th>ADOPTER</th>
                <th>HAVE PETS</th>
                <th>HAVE CHILDREN</th>
                <th>RESPOND REQUEST</th>
                <th>INFO</th>
            </tr>

            <?php foreach ($adoption_requests as $adoption_request) { ?>
                <tr style="font-size: 0.8rem;">
                <td><?= $adoption_request["animal_id"] ?></td>
                    <td>
                        <table>
                            <tr>
                                <td><img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                                <td><?= $adoption_request["name"] ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?= $adoption_request["type"] ?></td>
                    <td><?= $adoption_request["adopter"] ?></td>
                    <td><span class="tag <?= $adoption_request["r1"] ? 'green' : 'pink' ?>"><?= $adoption_request["r1"] ? "YES" : "NO" ?> </span></td>
                    <td><span class="tag <?= $adoption_request["r2"] ? 'green' : 'pink' ?>"><?= $adoption_request["r2"] ? "YES" : "NO" ?> </span></td>
                    <td>
                        <button title="Accept" class="btn btn-link btn-icon green"><i class="fas fa-check-circle"></i> </button>
                        &nbsp;
                        <button title="Reject" class="btn btn-link btn-icon pink"><i class="fas fa-times-circle"></i></button>
                    </td>
                    <td>
                        <button id="popupBtn" title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button>
                        <div id="popupModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h3>More Details</h3>
                                <div style="padding: 5px;"><button title="Adoptor Mobile" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-phone"></i></button><?= $adoption_request["contact"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Email" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-envelope"></i></button><?= $adoption_request["email"] ?></div>
                                <div style="padding: 5px;"><button title="Adoptor Address" class="btn btn-link btn-icon" style=" padding-right: 20px;"><i class="fas fa-map-marker-alt"></i></button><?= $adoption_request["address"] ?></div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>

<script>
    var modal = document.getElementById("popupModal");
    var btn = document.getElementById("popupBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>