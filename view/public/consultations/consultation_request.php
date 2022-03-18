<?php require __DIR__ . "/../../_layout/header.php"; ?>
<style>
  .radio-box {
    display: flex;
    flex-wrap: wrap;
  }

  .radio-box input {
    display: none;
  }

  .radio-box label {
    padding: .5rem 1rem;
    border: 2px solid var(--gray-3);
    display: block;
    border-radius: .4rem;
    cursor: pointer;
    margin-right: .3rem;
    text-align: center;
    margin-bottom: .3rem;
  }

  .radio-box label:hover {
    background: var(--gray-1);
  }

  input:checked:not(.ctrl-radio)+label {
    border: 2px solid currentColor;
    color: var(--primary);
    font-weight: 500;
    box-shadow: var(--shadow-light);
  }

  input:checked+label i {
    font-weight: 900;
  }

  input:disabled+label {
    opacity: .4;
    cursor: not-allowed;
    background-color: var(--gray-2);
  }

  .fa-star {
    color: var(--gray-3);
  }

  .checked {
    color: orange;
  }

  .message {
    position: absolute;
    width: 50%;
    height: 100%;
    background: #ffffffcc;
    top: 0;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
  }
</style>

<div style="max-width:900px;padding: 0 1rem;margin:0 auto;padding-bottom:1rem">
  <h2>Book Consultation</h2>
  <div class="stepper px2">
    <div class="step <?= $step == 1 ? 'active' : '' ?>">
      <i class="step-icon far fa-calendar-alt"></i>
      <span class="step-title">Date & Time</span>
    </div>
    <div class="step  <?= $step == 2 ? 'active' : '' ?>">
      <i class="step-icon far fa-paw"></i>
      <span class="step-title">Pet Information</span>
    </div>
    <div class="step <?= $step == 3 ? 'active' : '' ?>">
      <i class="step-icon far fa-credit-card"></i>
      <span class="step-title">Payment</span>
    </div>
  </div>
  <?php if (isset($_SESSION['user'])) {
    if ($step == 1) { ?>
      <form action='/Consultation' href="?step=2" method='POST' name="form1">
        <div style="display: grid; grid-gap:1rem; grid-template-columns: 1fr 2fr;margin-top:1rem">
          <div>
            <div class="field">
              <label>Doctor</label>
              <input class="ctrl">
            </div>
            <div class="radio-box" style="display: grid;">
              <?php foreach ($doctors as $doctor) { ?>
                <input name="doctor" id="doctor<?= $doctor["user_id"] ?>" type="radio" value="<?= $doctor["user_id"] ?>" <?= ($_SESSION['doctor'])  == $doctor["user_id"] ? "checked" : "" ?> required onclick="form1.submit()">
                <label for="doctor<?= $doctor["user_id"] ?>" style="text-align:left">
                  <div style="display: flex;align-items:center">
                    <div>
                      <div style="font-weight: 500;"><?= $doctor["name"] ?></div>
                      <div style="font-size: .9rem; margin-top:.3rem">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                      </div>
                    </div>
                  </div>
                </label>
              <?php } ?>
            </div>
          </div>
          <div>
            <div style="display: flex;">
              <div class="field">
                <label> Consultation Type </label>
                <div class="radio-box ">
                  <input name="consultation_type" id="live" type="radio" value="live" <?php if ($_SESSION['consultation_type'] == 'live') { ?>checked<?php } ?> onselect="displayTimes(this)" required>
                  <label for="live"><i class="far fa-webcam"></i> &nbsp; Video</label>
                  <input name="consultation_type" id="advise" type="radio" value="advise" <?php if ($_SESSION['consultation_type'] == 'advise') { ?>checked<?php } ?> onselect="displayTimes(this)">
                  <label for="advise"><i class="far fa-comments-alt"></i> &nbsp; Chat </label>
                </div>
              </div>
              <div class="field" style="max-width: 180px;margin-left:.5rem">
                <label>Date</label>
                <input class="ctrl" name="date" type="date" id="date" min="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>" <?php if (isset($_SESSION['date'])) { ?> value="<?= $_SESSION['date'];
                                                                                                                                                                                                                                                                  } ?>" onchange="form1.submit()" required>
              </div>
            </div>
            <div class="field">
              <label>Available Times</label>
              <div class="radio-box " id="time" style="display: grid; grid-template-columns: repeat(auto-fill,minmax(7rem,1fr));">
                <?php if (isset($slots)) {
                  foreach ($slots as $slot) { ?>
                    <input name="time" id="time_<?= $slot["time_slot"] ?>" value="<?= $slot["time_slot"] ?>" <?= isset($slot["consultation_id"]) ? "disabled" : "" ?> type="radio" <?php if ($_SESSION['time'] == $slot["time_slot"]) { ?>checked<?php } ?> required>
                    <label for="time_<?= $slot["time_slot"] ?>"><?= date('h:i A', strtotime(substr($slot["time_slot"], 0, 5))) ?></label>
                <?php }
                } ?>
              </div>
              <?php if (empty($slots)) { ?>
                <p>All time slots for this date are fully booked</p>
              <?php } ?>
            </div>
          </div>
        </div>
        <div style="text-align: center;margin:2rem;">
          <input class="btn green" type="submit" value="Make Consultation" name="step" />
        </div>
      </form>

    <?php } else if ($step == 2) {
      isset($_POST['step']) ?>

      <form action='/Consultation' href="?step=3" method='POST'>
        <div style="display: grid;grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));grid-gap:3rem;margin-top:1rem">

          <!-- Choose an existing pet -->
          <div class="field" id="old_pet">
            <label>Your Pets</label>
            <div class="radio-box" style="display: grid;">
              <?php foreach ($pets as $pet) {
                if ($pet['status'] == 'ACTIVE') { ?>
                  <input name="existing_pet" id="pet<?= $pet['animal_id'] ?>" type="radio" value=<?= $pet['animal_id'] ?> <?php if ($_SESSION['id'] == $pet['animal_id']) { ?>checked<?php } ?> onchange="hideNewPet()">
                  <label for="pet<?= $pet['animal_id'] ?>" style="text-align:left">
                    <div style="display: flex;align-items:center">
                      <div style="background:url(<?= $pet['photo']; ?>) center center;border-radius:50%;height:60px;width:60px;background-size:cover">
                      </div>
                      <div style="margin-left: 1rem;">
                        <div style="font-weight: 500;"><?= $pet['name'] ?></div>
                        <div style="font-weight: 300;"><?= $pet['age'] ?>Years Old</div>
                      </div>
                      <div style="flex:auto"></div>
                      <div style="margin-left: 1rem;">
                        <div><?= $pet['gender'] ?> &nbsp; <span class="tag green"><?= $pet['type'] ?></span></div>
                      </div>
                    </div>
                  </label>
              <?php }
              } ?>
            </div>
          </div>

          <!-- Add new pet -->
          <div id="new_pet">
            <h4 style="margin:0;margin-bottom:.5rem">A New Pet</h4>
            <div style="display: grid;grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); grid-column-gap:1rem">
              <div class="field">
                <label>Name </label>
                <input class="ctrl" type="text" href="?step=2" name="name" style="max-width: 200px;" <?php if (isset($_SESSION['pet_name'])) { ?>value=<?= $_SESSION['pet_name'];
                                                                                                                                                      } ?> onchange="hidePets()">
                <!--required-->
              </div>
              <div class="field">
                <label>Gender</label>
                <div style="display: flex; align-items: center;height: 2rem;">
                  <input id="male" class="ctrl-radio" type="radio" value="male" name="gender" <?php if ($_SESSION['gender'] == 'male') { ?>checked<?php } ?> />&nbsp &nbsp<label for="male">Male&nbsp; </label>
                  <input id="female" class="ctrl-radio" type="radio" value="female" name="gender" <?php if ($_SESSION['gender'] == 'female') { ?>checked<?php } ?> />&nbsp &nbsp<label for="female">Female&nbsp; </label>
                  <input id="unkown" class="ctrl-radio" type="radio" value="unknown" name="gender" <?php if ($_SESSION['gender'] == 'unkown') { ?>checked<?php } ?> />&nbsp &nbsp<label for="unknown">Unknown&nbsp; </label>
                </div>
              </div>
            </div>
            <div class="field">
              <label> Animal Type </label>
              <div class="radio-box ">
                <input name="animal_type" id="dog" type="radio" value="dog" <?php if ($_SESSION['animal_type'] == 'dog') { ?>checked<?php } ?>>
                <label for="dog"><i class="far fa-dog"></i><br>Dog</label>

                <input name="animal_type" id="cat" type="radio" value="cat" <?php if ($_SESSION['animal_type'] == 'cat') { ?>checked<?php } ?>>
                <label for="cat"><i class="far fa-cat"></i><br> Cat </label>

                <input name="animal_type" id="bird" type="radio" value="bird" <?php if ($_SESSION['animal_type'] == 'bird') { ?>checked<?php } ?>>
                <label for="bird"><i class="far fa-dove"></i><br> Bird</label>

                <input name="animal_type" id="other" type="radio" value="other" <?php if ($_SESSION['animal_type'] == 'other') { ?>checked<?php } ?>>
                <label for="other"><i class="far fa-paw"></i><br>Other </label>
              </div>
            </div>
            <div style="display: grid;grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); grid-column-gap:1rem">
              <div class="field">
                <label>DOB </label>
                <input class="ctrl" type="date" name="dob" required max="<?= getdate()['year'] ?>-<?= str_pad(getdate()['mon'], 2, "0", STR_PAD_LEFT) ?>-<?= str_pad(getdate()['mday'], 2, "0", STR_PAD_LEFT) ?>" <?php if (isset($_SESSION['dob'])) { ?> value=<?= $_SESSION['dob'];
                                                                                                                                                                                                                                                              } ?>>
                <span class=" field-msg">Approximate date if not known</span>
              </div>
            </div>
          </div>
        </div>
        <div style="display:flex;justify-content:space-between;margin:2rem;">
          <a class="btn btn-faded pink" href="?step=1">Back<a>
              <input type="submit" class="btn" href="?step=3" value="Continue" name="step">
        </div>
      </form>
    <?php
    } else if ($step == 3) {

      $doc = Doctor::findByUID($_SESSION['doctor']); ?>

      <div style="text-align: center;">
        <h3>Confirmation & Payment</h3>
        <table class="table">
          <tr>
            <td>Doctor:</td>
            <td><?= $doc[0]['name'] ?></td>
          </tr>
          <tr>
            <td>Consultation type:</td>
            <td><?= $_SESSION['consultation_type'] ?></td>
          </tr>
          <tr>
            <td>Date:</td>
            <td><?= $_SESSION['date'] ?></td>
          </tr>
          <tr>
            <td>Time:</td>
            <td><?= $_SESSION['time'] ?></td>
          </tr>
          <tr>
            <td>Pet's name:</td>
            <td><?= $_SESSION['pet_name'] ?></td>
          </tr>
          <tr>
            <td>Gender:</td>
            <td><?= $_SESSION['gender'] ?></td>
          </tr>
          <tr>
            <td>Animal type:</td>
            <td><?= $_SESSION['animal_type'] ?></td>
          </tr>
          <tr>
            <td>Date of Birth:</td>
            <td><?= $_SESSION['dob'] ?></td>
          </tr>
          <tr>
            <td>Doctor's Fee:</td>
            <td>Rs. <?= $_SESSION['consultation_type'] == "live" ? $doc[0]["live_charge"] : $doc[0]["advise_charge"] ?>.00</td>
          </tr>
        </table>
        <div style="display:flex;justify-content:space-between;margin:2rem;">
          <a class="btn btn-faded pink" href="?step=2">Back</a>
          <form method="post" action="/consultation/create_request"><button class="btn green">Continue to Payment</button></form>
        </div>
      </div>
    <?php }
  } else { ?>
    <div class="message">
      <i class="far fa-user-lock fa-5x txt-clr orange"></i> <br>
      <div style="font-weight: 600;"> Sign In Required</div> <br>
      <a class="btn green" href="/auth/sign_in">Sign In</a>
    </div>
  <?php } ?>
</div>

<script>
  function hideNewPet() {
    var fields = document.getElementById('new_pet').querySelectorAll('input');
    fields.forEach(function(fields) {
      if (fields.type == 'text') {
        fields.value = '';
      } else {
        fields.checked = 'false';
      }
      fields.disabled = true;
    });
  }

  function hidePets() {
    var pets = document.getElementsByName('existing_pet');
    pets.forEach(function(pets) {
      pets.checked = false;
      pets.disabled = true;
    });
  }

  function displayTimes(_this) {
    // times=document.getElementById('time');
    // date=document.getElementById("date");
    // if(_this.value=='live'){
    //   date.disabled=true;
    // } else{
    //   date.disabled=false;
    // }
  }

  // var dis1 = document.getElementById("dis_rm");
  // dis1.onchange = function() {
  //   if (this.value != "" || this.value.length > 0) {
  //     document.getElementById("dis_per").disabled = true;
  //   }
  // }
</script>