<?php


require_once  dirname(__FILE__) . './../_layout/layout.php';

$data["header"]["nav"] = false;
$data["user"] = "Dalana";

require  dirname(__FILE__) . "./../_layout/header.php";

$animals = array(
    array("id" => 1, "name" => "Tobi", "type" => "Dog", "age" => "dalana@gmail.com", "admin" => true),
    array("id" => 2, "name" => "Zeus", "type" => "Rabbit", "gender" => "Hiruni@gmail.com", "admin" => false),
    array("id" => 3, "name" => "Ellie", "type" => "Cat", "date_listed" => "Ovini@gmail.com", "admin" => false),
    array("id" => 4, "name" => "Nala", "type" => "Dog", "status" => "Tharani@gmail.com", "admin" => true),
);

?>

<style>
.table td{
    font-size: 0.5 rem;
    font-weight: 200;

}
</style>

<div class="container">
<h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
    Adoptees
    <button class="btn right">Add New Animal</button>
</h3>

<table class="table td">
    <tr>
        <th>PET</th>
        <th>AGE</th>
        <th>GENDER</th>
        <th>DATE LISTED</th>
        <th>STATUS</th>
        <th></th>
    </tr>

    <?php foreach ($animals as $animal) { ?>
    <tr>
        <td><?= $animal["name"] ?></td>
        <td></td>
        <td></td>
        <td>
            <button title="Change Role" class="btn btn-link btn-icon orange"><i class="fas fa-shield-alt"></i> </button>
            &nbsp;
            <button title="Reset Password" class="btn btn-link btn-icon green"><i class="fas fa-unlock-alt"></i></button>
            &nbsp;
            <button title="Delete User" class="btn btn-link btn-icon red"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
    <?php } ?>

</table>
</div>