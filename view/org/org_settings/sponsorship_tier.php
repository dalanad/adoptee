<?php require __DIR__ . "./../../_layout/header.php"; 
?>
<style>
.center {
     padding-top:40px;
        text-align: center;
        font-size: 25px;
    }

.section {
 
  width:30%;
 margin:auto;

}
.cen{
   display: flex;
  justify-content: center;
 width:30%
}
.btn-cen{
    text-align: center;  
}
</style>
<form class="container" action="/SponsorshipTier/getdata" method="POST">
<div class="center">
    <strong>Sponsorship Tier</strong>
</div>
<div class="section">
<div class="field">

<label for="name"><b>Name</b></label>
<input class="ctrl" type="text"  name="name" id="name" required>
<br>
<label for="amount"><b>Amount</b></label>
<input class="ctrl" type="number" name="amount" id="amount" required>
<br>
<label for="contribution">Contribution</label>
<textarea class="ctrl" id="description" name="description" style="height:200px"></textarea>
</div>

<div class="btn btn-cen">
        <button type="save" class="btn" >Save</button><br>
    </div>
</form>