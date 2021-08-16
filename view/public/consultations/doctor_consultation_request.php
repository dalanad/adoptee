<?php require __DIR__ . "./../../_layout/header.php"; ?>
<style>
  .type-sel input {
    display: none;
  }

  .type-sel label {
    padding: 2rem;
    border: 1px solid gray;
    margin: .2rem;
    display: block;
    border-radius: 25px;
    height: 15px;
  }

  input:checked+label {
    color: red;
  }

  .type-sel {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 10px 10px;
    align-content: center;
    padding-left: 0px;
    padding-top: 10px;
    text-align: center;
  }
</style>

<div class="container px2">
  <h2>Doctor Consultation</h2>
  <div>

    <?php

    $animals = array(
      array("id" => 1, "name" => "Tobi", "type" => "Dog", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => false),
      array("id" => 2, "name" => "Zeus", "type" => "Rabbit", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => false),
      array("id" => 3, "name" => "Ellie", "type" => "Cat", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => true),
      array("id" => 4, "name" => "Nala", "type" => "Dog", "age" => "3 Years", "gender" => "Male", "date_listed" => "01-01-2021", "status" => true),
    );

    ?>

    <table class="table">
      <tr>
        <th>PET</th>
        <th>TYPE</th>
        <th>AGE</th>
        <th>GENDER</th>
      </tr>
      <?php foreach ($animals as $animal) { ?>
        <tr>
          <td><?= $animal["name"] ?></td>
          <td><?= $animal["type"] ?></td>
          <td><?= $animal["age"] ?></td>
          <td><?= $animal["gender"] ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>

  <div style="display: grid;grid-template-columns:1fr 1fr 1fr">
    <div>
      Doctor Details
      Name,
      Address,
      Telephone
    </div>
    <div class="field">
      <label> Animal Type </label>
      <div class="p4 type-sel ">
        <input name="animal_type" id="dog" type="radio">
        <label for="dog"><i class="fa fa-dog"></i><br>Dog</label>

        <input name="animal_type" id="cat" type="radio">
        <label for="cat"><i class="fa fa-cat"></i><br> Cat </label>

        <input name="animal_type" id="bird" type="radio">
        <label for="bird"><i class="fa fa-dove"></i><br> Bird</label>

        <input name="animal_type" id="other" type="radio">
        <label for="other"><i class="fa fa-paw"></i><br>Other </label>
      </div>
    </div>
    <div>
      <div class="field">
        <label>Date</label>
        <input class="ctrl" type="date">
      </div>
      <div class="field my2">
        <label>Available Times</label>
        10.00 AM - 10.30 AM - 11.00 AM - 11.30 AM - 12.00 AM - 12.30 AM - 1.00 PM
      </div>
      <button class="btn">Make Consultation</button>
    </div>
  </div>
</div>