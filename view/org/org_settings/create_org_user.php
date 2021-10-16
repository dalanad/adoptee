<?php require __DIR__ . "/../../_layout/layout.php"; 
?>
<style>

.page{
    padding-left:300px;
    padding-right:300px;
    
}

.column {
  float: left;
  width: 30%;
  padding: 10px;
  height: 300px;
  font-size:20px ;
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
<div style="padding: 1rem 1rem;display: flex;">
        <?php if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } ?>
        <div style="flex: 1 1 0;"></div>
        <?= user_btn() ?>
    </div>
<div class="column">
    <strong>Create Organization User</strong><br><br>
    <div class="field">
    <label for="name"><strong>Name</strong></label>

<input class="ctrl" type="text"  name="name" id="name" required>
<span class="field-msg">Name</span>
</div>

<button class="btn btn-blue" type="submit">Submit</button><br><br>

<a class=" btn btn-faded pink" href="/view/org/settings.php?menu=users"><strong>Go Back</strong></a>
</div>

<div class="column"><br><br>
<div class="field">
    <label for="name"><strong>Email Adress</strong></label>
<input class="ctrl" type="text"  name="email" id="email" required>
<span class="field-msg">Email Adress</span>