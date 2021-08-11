<?php require __DIR__ . "./../../_layout/header.php"; ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
  .left {
    padding-top: 50px;
    padding-left: 70px;
    text-align: left;
    font-size: 30px;
    font-family: forte, sans serif;

    margin-top: 50px;
    margin-left: 80px;
  }

  .num {
    color: purple;
    font-size: 20px;
    font-family: arial, sans serif;
  }

  .right {
    padding-top: 50px;
    padding-right: 80px;
    font-size: 30px;
    font-family: arial, sans serif;
    margin-top: 50px;
    margin-right: 80px;
    text-align: right;
    width: 500px;
    font-family: forte, sans serif;
  }

  a:link {
    color: blue;
    text-decoration: none;
  }

  a:visited {
    text-decoration: underline;
  }

  a:hover {
    color: black;
    text-decoration: underline;
  }

  a:active {
    color: red;
    text-decoration: none;
  }
</style>
<div class=" left">
  <p>Emergency Contact Numbers</p>
  <p><i class="material-icons">phone</i>Contact Info</p>

  <p><span class="num" id="myInput">Dalana: <a href="tel:+94111111111">+94 11 111 1111</a><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button></span> </p>

  <p><span class="num" id="myInput">Hiruni: <a href="tel:+94112222222">+94 11 222 2222</a><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button></span> </p>
  <p><span class="num" id="myInput">Ovini: <a href="tel:+94113333333">+94 11 333 3333</a><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button></span> </p>
  <p><span class="num" id="myInput">Tharani: <a href="tel:+94114444444">+94 11 444 4444</a><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button></span> </p>
</div>
</div>
<div class="right">
  <p><i class="material-icons">message</i>Need A Help?Send Us A Message</i></p>
  <div class="field">
    <span class="num">
      <label for="fname"></label>
      <input class="ctrl" type="text" id="fname" placeholder="Your name..">
      <label for="email"></label>
      <input class="ctrl" type="text" id="email" placeholder="Your email..">

      <label for="subject"></label>
      <textarea class="ctrl" id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

      <br>
      <div class="btn">
        <button type="submit" class="btn">send message</button>
    </span>
  </div>
</div>
<script>
  function myFunction() {
    var copynum = document.getElementById("myInput");
    copynum.select();
    copynum.setSelectionRange(0, 99999)
    document.execCommand("copy");

  }
</script>