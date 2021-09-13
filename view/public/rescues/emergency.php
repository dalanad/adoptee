<?php require __DIR__ . "/../../_layout/header.php"; ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<style>
  .split {
  height: 80%;
  width: 50%;
  position: fixed;
  overflow-x: hidden;
  padding-top: 20px;
}
  .left {
    padding-top: 50px;
    padding-left: 70px;
    text-align: left;
    font-size: 30px;
    font-family: forte, sans serif;

    margin-top: 50px;
    margin-left: 80px;
  }
  .lefts {
  left: 0;
  padding-left: 70px;
  margin-left: 80px;
  font-size: 30px;
  font-family: inherit, sans serif;
}

  .num {
    color: purple;
    font-size: 25px;
    font-family: arial, sans serif;
  }

  .table {
width:50%
    }
       
  .right {
    padding-top: 50px;
    padding-right: 50px;
    font-size: 30px;
    margin-top: 50px;
    margin-right: 80px;
    text-align: right;
    width: 500px;
    font-family: inherit, sans serif;
  }
  .rights {
  right: 0;
  margin-right: 80px;
  font-size: 30px;
    font-family: inherit, sans serif;
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
<div class=" split lefts">
  <p><strong>Emergency Contact Numbers</strong></p>
  <p><i class="material-icons">phone</i><strong>Contact Info</strong></p>
  <div class="num" id="myInput">
  <table>

  <tr>
    <td>Dalana:</td>
    <td> <a href="tel:+94111111111">+94 11 111 1111</a></td>
    <td><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button> </td></tr>
    <tr>
    <td>Hiruni:</td>
    <td> <a href="tel:+94112222222">+94 11 222 2222</a></td>
    <td><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button> </td></tr>
    <tr>
    <td>Ovini:</td>
    <td> <a href="tel:+94113333333">+94 11 333 3333</a></td>
    <td><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button> </td></tr>
 <tr>
 <td>Tharani:</td>
    <td> <a href="tel:+94114444444">+94 11 444 4444</a></td>
    <td><button class="btn btn-link" onclick="myFunction()"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy</button> </td></tr>
</table>

</div>
</div>
<div class="split rights">
  <p><i class="material-icons">message</i><strong>Need A Help?Send Us A Message</strong></i></p>
  <div class="field">
    <span class="num">
      <label for="fname"></label>
      <input class="ctrl" type="text" id="fname" placeholder="Your name.."><br><br>
      <label for="email"></label>
      <input class="ctrl" type="text" id="email" placeholder="Your email.."><br><br>

      <label for="subject"></label>
      <textarea class="ctrl" id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

      <br>
      <div class="btn">
        <button type="submit" class="btn"><strong>send message</strong></button>
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