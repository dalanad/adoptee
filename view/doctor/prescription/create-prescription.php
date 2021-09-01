<?php require_once  dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
  .cls {
    padding-top: 80px;
    padding-left: 500px;
    width: 500px;
  }

  .center {
    padding-top: 60px;
    padding-left: 600px;
    text-align: center;
    font-size: 40px;
    font-family: arial, sans serif;
  }
</style>

<span class="center"><b>Create prescriptions</b></span>

<div class="cls">

  <div class="field">
    <label for="email"><b>Enter email</b></label>
    <p> <input class="ctrl" type="text" placeholder="Enter email  " name="email" id="email" required>
      <button type="submit" class="btn"> <i class="material-icons">search</i>Search</button>
    </p>

  </div>
  <p> <input class="btn" type="file" id="myFile" name="filename"></p>
  <button class="btn" type="submit">Send</button>