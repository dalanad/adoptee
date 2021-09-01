<?php

$adoption_requests = array(
    array("id" => 1, "adoptee" => "Tobi", "type" => "Dog", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => false, "r2" => false),
    array("id" => 2, "adoptee" => "Zeus", "type" => "Rabbit", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => false, "r2" => true),
    array("id" => 3, "adoptee" => "Ellie", "type" => "Cat", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => true, "r2" => true),
    array("id" => 4, "adoptee" => "Nala", "type" => "Dog", "adopter" => "Mark", "contact" => "0771234567", "email" => "abc@gmail.com", "address" => "123/A, Colombo 07, Sri Lanka", "r1" => true, "r2" => true),
);

?>

<div class="container">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        ADOPTION REQUESTS
    </h3>

    <div class="overflow-auto" style="height:450px">
        <table class="table">
            <tr>
                <th>ADOPTEE</th>
                <th>ADOPTEE TYPE</th>
                <th>ADOPTER</th>
                <th>CONTACT DETAILS</th>
                <th>HAVE PETS</th>
                <th>HAVE CHILDREN</th>
                <th>RESPOND REQUEST</th>
                <th></th>
            </tr>

            <?php foreach ($adoption_requests as $adoption_request) { ?>
                <tr style="font-size: 0.8rem;">
                    <td><?= $adoption_request["adoptee"] ?></td>
                    <td><?= $adoption_request["type"] ?></td>
                    <td><?= $adoption_request["adopter"] ?></td>
                    <td>
                        <button title="mobile" class="btn btn-link btn-icon"><i class="fas fa-phone"></i> </button>
                        &nbsp;
                        <button title="email" class="btn btn-link btn-icon"><i class="fas fa-envelope"></i></button>
                        &nbsp;
                        <button title="address" class="btn btn-link btn-icon"><i class="fas fa-map-marker-alt"></i></button>
                    </td>
                    <td><span class="tag <?= $adoption_request["r1"] ? 'green' : 'pink' ?>"><?= $adoption_request["r1"] ? "YES" : "NO" ?> </span></td>
                    <td><span class="tag <?= $adoption_request["r2"] ? 'green' : 'pink' ?>"><?= $adoption_request["r2"] ? "YES" : "NO" ?> </span></td>
                    <td>
                        <button title="Accept" class="btn btn-link btn-icon green"><i class="fas fa-check-circle"></i> </button>
                        &nbsp;
                        <button title="Reject" class="btn btn-link btn-icon pink"><i class="fas fa-times-circle"></i></button>
                    </td>
                    <td><button title="More Details" class="btn btn-link btn-icon"><i class="fas fa-info-circle"></i></button></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>