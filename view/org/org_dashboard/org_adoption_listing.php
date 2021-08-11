<?php

$animals = array(
    array("id" => 1, "name" => "Tobi", "type" => "Dog", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => false),
    array("id" => 2, "name" => "Zeus", "type" => "Rabbit", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => false),
    array("id" => 3, "name" => "Ellie", "type" => "Cat", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => true),
    array("id" => 4, "name" => "Nala", "type" => "Dog", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => true),
);

?>

<div class="container">
<h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
    Adoptees
    <a href="./org_dashboard/add_new_animal.php"><button class="btn right">Add New Animal</button></a>
</h3>

<table class="table">
    <tr>
        <th>PET</th>
        <th>TYPE</th>
        <th>AGE</th>
        <th>GENDER</th>
        <th>DATE LISTED</th>
        <th>STATUS</th>
        <th></th>
    </tr>

    <?php foreach ($animals as $animal) { ?>
    <tr style="font-size: 0.8rem;">
        <td><?= $animal["name"] ?></td>
        <td><?= $animal["type"] ?></td>
        <td><?= $animal["age"] ?></td>
        <td><?= $animal["gender"] ?></td>
        <td><?= $animal["date_listed"] ?></td>
        <td><span class="tag <?= $animal["status"] ? 'green' : 'pink' ?>"><?= $animal["status"] ? "ADOPTED" : "LISTED" ?> </span></td>
        <td><button title="Edit" class="btn btn-link btn-icon"><i class="fas fa-pen"></i> &nbsp Edit </button></td>
    </tr>
    <?php } ?>

</table>
</div>