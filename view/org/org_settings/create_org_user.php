<?php require __DIR__ . "./../../_layout/header.php"; 
?>
<style>
.page{
    padding-left:300px;
    padding-right:300px;
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
</style>
<div class="row page">
    <h1>Doctor Consultation</h1>
    
<div class="column">
    <strong>Create Organization User</strong><br><br>
    <div class="field">
    <label for="name"><strong>Name</strong></label>

<input class="ctrl" type="text"  name="name" id="name" required>
<span class="field-msg">Name</span>
</div>

<button class="btn btn-blue" type="submit">Submit</button>
</div>

<div class="column"><br><br>
<div class="field">
    <label for="name"><strong>Email Adress</strong></label>
<input class="ctrl" type="text"  name="email" id="email" required>
<span class="field-msg">Email Adress</span>