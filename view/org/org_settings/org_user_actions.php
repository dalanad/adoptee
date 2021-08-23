<?php require __DIR__ . "./../../_layout/header.php"; 
?>
<style>
  
.section {
 width:30%;
margin:auto;
border-radius: 10px;
  padding: 20px;
  font-size:15px;
  border-style: outset;
}
.fieldm {
	padding-bottom: 0.5em;
	flex-direction: column;
	justify-content: start;
    width:50%;
}

.btn-green {
	background-color:#00FF7F;
	border: 1px solid #00FF7F;
}
.btn-orange {
	background-color:orange;
	border: 1px solid orange;
}
.btn-pink {
	background-color:#FFFACD;
	border: 1px solid #FFFACD;
    color:red;
}

</style>
<br><br>
<div class="section ">
<h3>Organization User - Actions</h3><br>
<div class="fieldm">
<label for="role"><strong>Role</strong></label>
<select class="ctrl" name="role" id="role">
    <option value="admin">ADMIN</option>
    <option value="organization user">ORGAIZATION USER</option>
    <option value="registerd user">REGISTERED USER</option>
    <option value="doctor">DOCTOR</option>
</select>
</div>
<div class="btn green">
<button class="btn green" type="submit">Accept</button>
</div>
<hr>
<strong>If the user has forgotten the password</strong><br><br>
<div class="btn btn-orange">
<button class="btn btn-orange" type="submit">Reset Password</button>
</div>
<br><br>
<hr>
<strong>Disable Access to the user</strong><br><br>
<div class="btn btn-pink">
<button class="btn btn-pink" type="submit"><i class="fa fa-trash"></i> Delete User</button>
</div>

