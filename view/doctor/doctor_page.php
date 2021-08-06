<?php require_once  dirname(__FILE__) . './_layout/layout.php' ;
require dirname(__FILE__) . "./_layout/header.php"
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
  .hed{
    text-align:center;
    color: var(--color);
	font-size: 40px;
    font-family:forte,sans serif;
    }
    .body{
    padding-top:30px;
    text-align:center;
    color: var(--color);
	font-size: 20px;
    font-family:arial,sans serif;
    margin:auto;
    width:500px;
    }

</style>
<div class="hed">
<p>Welcome to Adoptee As A Doctor</p>
<div class="body">
<label for="search"><p><b>View Requests</p> </b></label>
<div class ="btn" >
<a class="btn" href="/view/accept_request.php"> <i class="material-icons">search</i></a><br>
</div>

<label for="search"><p><b>View Health Records </p> </b></label>
<div class ="btn" >
<a class="btn" href="/view/accept_request.php"> <i class="material-icons">search</i></a><br>
</div>

<label for="search"><p><b>View Photo Uploads</p> </b></label>
<div class ="btn" >
<a class="btn" href="/view/photo_uploads.php"> <i class="material-icons">search</i></a><br>
</div>
<label for="search"><p><b>Create Prescriptions</p> </b></label>
<div class ="btn" >
<a class="btn" href="/view/create_prescription.php"> <i class="material-icons">search</i></a><br>
</div>
