<?php require __DIR__ . "./../../_layout/header.php"; ?>
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

  input:checked+label {
    border: 2px solid currentColor;
    color: var(--primary);
    font-weight: 500;
    box-shadow: var(--shadow-light);
  }

  input:checked+label i {
    font-weight: 900;
  }
</style>

<div style="max-width:900px;padding: 0 1rem;margin:0 auto;padding-bottom:1rem">

  <h2>Book Consultation</h2>
  <div class="stepper px2">
    <div class="step active">
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
  <div style="display: grid; grid-gap:1rem; grid-template-columns: 1fr 2fr;margin-top:1rem">
    <div>
      <div class="field">
        <label>Doctor</label>
        <input class="ctrl">
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
    <button class="btn green">Make Consultation</button>
  </div>
  <div>
    <div class="field">
      <label>Choose Your Pet</label>
      <div class="radio-box" style="display: grid;">
        <?php for ($i = 0; $i < 3; $i++) { ?>
          <input name="pet" id="pet<?= $i ?>" type="radio">
          <label for="pet<?= $i ?>" style="text-align:left">
            ƪ(˘⌣˘)ʃ &nbsp; Zeus - Dog - Male - 7 Years old
          </label>
        <? } ?>
        <button class="btn btn-faded green">Add New Pet</button>
      </div>
    </div>
    <div>
      Animal Form
    </div>
  </div>
  <div>
    <h3>Make Payment</h3>
  </div>
</div>
<!-- <div class="field">
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
      </div> -->