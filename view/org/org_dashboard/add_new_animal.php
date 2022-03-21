<?php require __DIR__ . "/../../_layout/header.php"; ?>

<style>
  .ctrl2 {
    padding: 0.4em 0.5em;
    line-height: 1;
    border-radius: 8px;
    font-family: inherit;
    color: var(--color);
    font-size: 1rem;
    border: 0.1rem solid var(--muted);
    background: var(--gray-1);
    width: 70%;
    box-sizing: border-box;
  }

  .row {
    display: flex;
  }

  .column {
    margin-right: 1rem;
    flex: 50%;
  }

  .box {
    display: none;
  }

  .check {
    display: flex;
    flex-wrap: wrap;
  }

  .check input {
    display: none;
  }

  .check label {
    padding: 1rem;
    border: 2px solid var(--gray-3);
    display: block;
    border-radius: 50%;
    cursor: pointer;
    margin-right: .3rem;
    text-align: center;
    margin-bottom: .3rem;
  }

  .check input:checked+label {
    opacity: 0.5;
    border-color: var(--primary);
  }

  .tooltip {
    position: relative;
    display: inline-block;
    height: 40px;
    border-bottom: 1px transparent;
  }

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: -5px;
    left: 110%;
  }

  .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 100%;
    margin-top: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent black transparent transparent;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
  }
</style>

<div class='container px2'>
  <div>
    <a href="/OrgManagement/org_adoption_listing" class="btn btn-link btn-icon mr1 " style="font-size: 1em;"><i class="fa fa-arrow-left"></i></a>
  </div>
  <h3 class='mt1 txt-clr'>Add New Animal for Adoption</h3>
  <form action="/OrgManagement/process_add_new_animal" method="post" enctype="multipart/form-data">

    <div class="row">
      <div class='field column'>
        <label for='name'>Name</label>
        <input class="ctrl" type="text" name="name" required />
      </div>

      <input type="hidden" name="rescue_report_id" value="<?= $_GET['report_id']?>">

      <div class='field column'>
        <label for='type'>Type</label>
        <select class="ctrl" name='type' required>
          <option selected='true' disabled='disabled'>Select</option>
          <option value='Dog'>Dog</option>
          <option value='Cat'>Cat</option>
        </select>
      </div>
    </div>
    
    <div class="row">
      <div class='field column'>
        <label for='gender'>Gender</label>
        <select class="ctrl" name='gender' required>
          <option selected='true' disabled='disabled'>Select</option>
          <option value='male'>Male</option>
          <option value='female'>Female</option>
        </select>
      </div>

      <div class='field column'>
        <label for='dob'>Approximate DOB</label>
        <div>
          <input class="ctrl2" type="date" max="" name="dob" id="datefield" onclick="ageCalculator()" required />
          <p id="result"></p>
        </div>
      </div>
    </div>


    <div class="row">
      <div class='field column'>
        <div class='field'>
          <label for="color"> Color </label>
          <div class="check">
            <input id="white" name="color[]" type="checkbox" value="White">
            <label for="white" style="background:cornsilk;" title="White"></label>
            <input id="grey" name="color[]" type="checkbox" value="Grey">
            <label for="grey" style="background:grey;" title="Grey"></label>
            <input id="orange" name="color[]" type="checkbox" value="Orange">
            <label for="orange" style="background:darkgoldenrod;" title="Orange"></label>
            <input id="brown" name="color[]" type="checkbox" value="Brown">
            <label for="brown" style="background:brown;" title="Brown"></label>
            <input id="black" name="color[]" type="checkbox" value="Black">
            <label for="black" style="background:black;color:white;" title="Black"></label>
          </div>
        </div>
        <div class='field column'>
          <div class="row">
            <div class="field column">
              <label style="margin-top: 1rem; margin-bottom: 1rem;">Initial Vaccine</label>
              <br>
              <div style="margin: 0.5rem;">
                <label for='anti_rabies'>Anti Rabies</label>
                <div><input class="ctrl2" type="date" name="anti_rabies" max="" id="datefield"></div>
              </div>
              <div class="Dog box" style="margin: 0.5rem;">
              <label for='dhl'>DHL</label>
              <div><input class="ctrl2" type="date" name="dhl" max="" id="datefield"></div>
              </div>
              <div style="margin: 0.5rem;">
              <label for='parvo'>Parvo</label>
              <div><input class="ctrl2" type="date" name="parvo" max="" id="datefield"></div>
              </div>
              <div  class="Cat box" style="margin: 0.5rem;">
              <label for='tricat'>Tricat</label>
              <div><input class="ctrl2" type="date" name="tricat" max="" id="datefield"></div>
              </div>
              <div>
                <span class="field-msg">Select date only if vaccinated</span>
                <br>
              </div>
            </div>
            <div class="field column">
              <label style="margin-top: 1rem; margin-bottom: 1rem;">Yearly Booster</label>
              <br>
              <div style="margin: 0.5rem;">
              <label for='anti_rabies_booster'>Anti Rabies Booster</label>
              <div><input class="ctrl2" type="date" name="anti_rabies_booster" max="" id="datefield"></div>
              </div>
              <div  class="Dog box" style="margin: 0.5rem;">
              <label for='dhl_booster'>DHL Booster</label>
              <div><input class="ctrl2" type="date" name="dhl_booster" max="" id="datefield"></div>
              </div>
              <div style="margin: 0.5rem;">
              <label for='parvo_booster'>Parvo Booster</label>
              <div><input class="ctrl2" type="date" name="parvo_booster" max="" id="datefield"></div>
              </div>
              <div  class="Cat box" style="margin: 0.5rem;">
              <label for='tricat_booster'>Tricat Booster</label>
              <div><input class="ctrl2" type="date" name="tricat_booster" max="" id="datefield"></div>
              </div>
              <div>
                <span class="field-msg">Select date only if vaccinated this year</span>
                <br>
              </div>
            </div>
          </div>
          <div class='field'>
            <div>
            <label for='dewormed'>Dewormed</label>
            <div><input class="ctrl2" type="date" name="dewormed" max="" id="datefield"></div>
            </div>
            <div>
              <span class="field-msg">Select date only if dewormed within the past 6 months</span>
            </div>
          </div>
        </div>
      </div>
      <br>

      <div class='field column'>
        <label>Description</label>
        <textarea rows="14" class="ctrl" name="description" id="editor"></textarea>
        <span class="field-msg"> </span>
      </div>
    </div>

    <div class="row">
      <div class="field column">
        <label>Upload Proof Documents of Vaccination</label>
        <div class="ctrl-group">
          <span class="ctrl static"><i class="fa fa-image"></i></span>
          <input type="file" name="vacc_proof[]" class="ctrl" multiple accept="image/*" required>
        </div>
        <span class="field-msg">Upload a photo of the vaccination report / a letter from a medical official</span>
      </div>
      <div class="field column"">
      </div>
    </div>
    <br>

    <div class="row">
      <div class="field column">
        <label>Upload Photo for Avatar</label>
        <div class="ctrl-group">
          <span class="ctrl static"><i class="fa fa-image"></i></span>
          <input type="file" name="avatar_photo" class="ctrl" accept="image/*" required>
        </div>
        <span class="field-msg">Upload photo for profile image</span>
      </div>

      <div class="field column">
        <label>Upload Other Photos</label>
        <div class="ctrl-group">
          <span class="ctrl static"><i class="fa fa-images"></i></span>
          <input type="file" name="adoptee_photo[]" class="ctrl" multiple accept="image/*" required>
        </div>
        <span class="field-msg">Upload other photos of the animal</span>
      </div>

    </div>
    <br>
    <button class='btn mr2' type='reset'>Clear</button>
    <button class='btn mr2' type="submit">Add</button>
  </form>

</div>

<script>
  $(document).ready(function() {
    $("select").change(function() {
      $(this).find("option:selected").each(function() {
        var optionValue = $(this).attr("value");
        if (optionValue) {
          $(".box").not("." + optionValue).hide();
          $("." + optionValue).show();
        } else {
          $(".box").hide();
        }
      });
    }).change();
  });

  ClassicEditor
    .create(document.querySelector('#editor'), {
      toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link', '|', 'numberedList', 'bulletedList']
    })
    .catch(error => {
      console.log(error);
    });

  //Max Date input
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1;
  var yyyy = today.getFullYear();
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }

  today = yyyy + '-' + mm + '-' + dd;
  document.getElementById("datefield").setAttribute("max", today);

  /*  function ageCalculator() {
     var userinput = document.getElementById("dob").value;
     var dob = new Date(userinput);
     if (userinput == null || userinput == '') {
       document.getElementById("message").innerHTML = "Please select a date";
       return false;
     } else {

       //calculate month difference from current date in time  
       var month_diff = Date.now() - dob.getTime();

       //convert the calculated difference in date format  
       var age_dt = new Date(month_diff);

       //extract year from date      
       var year = age_dt.getUTCFullYear();

       //now calculate the age of the user  
       var age = Math.abs(year - 1970);

       //display the calculated age  
       return document.getElementById("result").innerHTML =
         "Age: " + age + " years. ";
     }
   } */
</script>