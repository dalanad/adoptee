<?php require __DIR__ . "./../../_layout/header.php"; 
?>
<style>
.page{
    padding-left:200px;
    padding-right:200px;
    padding-top:30px;
}

.column {
  float: left;
  width: 30%;
  padding: 10px;
  height: 300px;
  font-size:18px ;
  font-family:Calibri,sans serif;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}

.btn-blue {
	background-color: blue;
	border: 1px solid blue;
}
.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
  border-radius: 12px;
}

.type-sel input {
        display: none;
    }
    .type-sel label{
        padding:2rem ;
        border: 1px solid gray;
        margin: .2rem;
        display: block;
        border-radius: 25px; 
        height: 15px; 
    }
    input:checked + label {
        color: red;
    }
    .type-sel {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px 10px;
        align-content: center;
        padding-left:0px;
        padding-top:10px;
        text-align: center;
    }
</style>

<div class="row page">
    <h1>Doctor Consultation</h1>
  <div class="column"  >
  <strong>Doctor Details</strong><br><br>
   Name:Full Name<br>
   Address:Address<br>
   Telephone:0112255444<br>
  </div>
  <div class="column" >
  <br><br>
  <strong>Animal Type</strong>

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
  <div class="column" >
    <br><br>
    
    <label for="date"><strong>Date</strong></label>
  <input class="ctrl" type="date" id="date" name="date"><br><br>
  <strong>Available Times</strong><br>
10.00 AM-10.30 AM-11.00 AM-11.30 AM-12.00 PM-12.30 PM-1.00 PM
<br><br>
<button class="btn btn-blue" type="submit">Make Cosultation</button>
  </div>
</div>