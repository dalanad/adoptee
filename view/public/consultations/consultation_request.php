<?php require __DIR__ . "/../../_layout/header.php"; ?>
<?php $step = isset($_GET["step"]) ? $_GET["step"] : 1; ?>
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

  input:checked:not(.ctrl-radio)+label {
    border: 2px solid currentColor;
    color: var(--primary);
    font-weight: 500;
    box-shadow: var(--shadow-light);
  }

  input:checked+label i {
    font-weight: 900;
  }

  .fa-star {
    color: var(--gray-3);
  }

  .checked {
    color: orange;
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
    <div class="step  <?= $step == 3 ? 'active' : '' ?>">
      <i class="step-icon far fa-credit-card"></i>
      <span class="step-title">Payment</span>
    </div>
  </div>
  <?php if ($step == 1) { ?>
    <div style="display: grid; grid-gap:1rem; grid-template-columns: 1fr 2fr;margin-top:1rem">
      <div>
        <div class="field">
          <label>Doctor</label>
          <input class="ctrl">
        </div>
        <div class="radio-box" style="display: grid;">
          <?php for ($i = 0; $i < 3; $i++) { ?>
            <input name="pet" id="pet<?= $i ?>" type="radio">
            <label for="pet<?= $i ?>" style="text-align:left">
              <div style="display: flex;align-items:center">
                <div>
                  <div style="font-weight: 500;">Dr. Wikramasinghe</div>
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
          <? } ?>
        </div>
      </div>
      <div>
        <div style="display: flex;">
          <div class="field">
            <label> Consultation Type </label>
            <div class="radio-box ">
              <input name="animal_type" id="video" type="radio">
              <label for="video"><i class="far fa-webcam"></i> &nbsp; Video</label>
              <input name="animal_type" id="Chat" type="radio">
              <label for="Chat"><i class="far fa-comments-alt"></i> &nbsp; Chat </label>
            </div>
          </div>
          <div class="field" style="max-width: 180px;margin-left:.5rem">
            <label>Date</label>
            <input class="ctrl" type="date">
          </div>
        </div>
        <div class="field">
          <label>Available Times</label>
          <?php $times = array("10.00 AM", "10.30 AM", "11.00 AM", "11.30 AM", "12.00 AM", "12.30 AM", "1.00 PM"); ?>
          <div class="radio-box " style="display: grid; grid-template-columns: repeat(auto-fill,minmax(7rem,1fr));">
            <?php foreach ($times as $time) { ?>
              <input name="time" id="time_<?= $time ?>" type="radio">
              <label for="time_<?= $time ?>"><?= $time ?></label>
            <? } ?>
          </div>
        </div>
      </div>
    </div>
    <div style="text-align: center;margin:2rem;">
      <a class="btn green" href="?step=2">Make Consultation</a>
    </div>
  <? } else if ($step == 2) { ?>
    <div style="display: grid;grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));grid-gap:3rem;margin-top:1rem">
      <div class="field">
        <label>Your Pets</label>
        <div class="radio-box" style="display: grid;">
          <?php for ($i = 0; $i < 3; $i++) { ?>
            <input name="pet" id="pet<?= $i ?>" type="radio">
            <label for="pet<?= $i ?>" style="text-align:left">
              <div style="display: flex;align-items:center">
                <div style="background:url('/assets/images/dogs/placeholder2.jpg') center center;border-radius:50%;height:60px;width:60px;background-size:cover">
                </div>
                <div style="margin-left: 1rem;">
                  <div style="font-weight: 500;">Marko</div>
                  <div style="font-weight: 300;">7 Years old</div>
                </div>
                <div style="flex:auto"></div>
                <div style="margin-left: 1rem;">
                  <div>Male &nbsp; <span class="tag green">DOG</span></div>
                </div>
              </div>
            </label>
          <? } ?>
        </div>
      </div>
      <div>
        <h4 style="margin:0;margin-bottom:.5rem">A New Pet</h4>
        <div style="display: grid;grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); grid-column-gap:1rem">
          <div class="field">
            <label>Name </label>
            <input class="ctrl" type="text" name="name" required>
          </div>
          <div class="field">
            <label>Gender</label>
            <div style="display: flex; align-items: center;height: 2rem;">
              <input id=male class="ctrl-radio" type="radio" value="1" name="has_pets" />&nbsp; &nbsp;<label for="male">Male&nbsp; </label>
              <input id="female" class="ctrl-radio" type="radio" value="0" name="has_pets" />&nbsp; &nbsp;<label for="female">Female&nbsp; </label>
            </div>
          </div>
        </div>
        <div class="field">
          <label> Animal Type </label>
          <div class="radio-box ">
            <input name="animal_type" id="dog" type="radio">
            <label for="dog"><i class="far fa-dog"></i><br>Dog</label>

            <input name="animal_type" id="cat" type="radio">
            <label for="cat"><i class="far fa-cat"></i><br> Cat </label>

            <input name="animal_type" id="bird" type="radio">
            <label for="bird"><i class="far fa-dove"></i><br> Bird</label>

            <input name="animal_type" id="other" type="radio">
            <label for="other"><i class="far fa-paw"></i><br>Other </label>
          </div>
        </div>
        <div style="display: grid;grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); grid-column-gap:1rem">
          <div class="field">
            <label>DOB </label>
            <input class="ctrl" type="date" name="name" required>
            <span class="field-msg">Approximate date if not known</span>
          </div>
        </div>
      </div>
    </div>
    <div style="display:flex;justify-content:space-between;margin:2rem;">
      <a class="btn btn-faded pink" href="?step=1">Back</a>
      <a class="btn" href="?step=3">Continue</a>
    </div>
  <? } else if ($step == 3) { ?>
    <div style="text-align: center;">
      <h3>Confirmation & Payment</h3>
      <div>
        Confirm Consultation Details + Payment Amount
      </div>
      <div style="display:flex;justify-content:space-between;margin:2rem;">
        <a class="btn btn-faded pink" href="?step=2">Back</a>
        <a class="btn green">Continue to Payment</a>
      </div>
    </div>
  <? } ?>
</div>
<!-- -->