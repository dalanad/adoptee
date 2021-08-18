<?php require __DIR__ . "./../../_layout/header.php"; ?>

<style>
.ctrl2 {
	padding: 0.4em 0.5em;
	line-height: 1;
	border-radius: 8px;
	font-family: inherit;
	color: var(--color);
	font-size: 1rem;
	border: 0.2rem solid var(--gray-2);
	background: var(--gray-1);
	width: 32.5%;
	box-sizing: border-box;
}

.field-font{
    font-size: 0.8rem;
}

.box {
      display: none;
    }

.other {
    }

</style>

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
</script>

<div class='container px2'>
    <div class='placeholder-box mr1' style='height:50px; width:100px;'>Logo</div>
    <div>
        <a href="./../dashboard.php" class="btn btn-link btn-icon mr1 " style="font-size: 1em;"><i class="fa fa-arrow-left"></i></a>
    </div>
    <h3 class='mt1 txt-clr'>Add New Animal for Adoption</h3>
    <form action="/adoptionrequest/process_add_new_animal" method="post"> 
        <div class='field'>
            <label for='type'>Type</label>
                <select class="ctrl field-font" name='type' required>
                    <option selected='true' disabled='disabled'>Select</option>
                    <option value='dog'>Dog</option>
                    <option value='cat'>Cat</option>
                    <option value='other'>Other</option>
                </select>
        </div>

        <div class='field other box'>
            <label for='type'>Other</label>
            <input class="ctrl field-font" type="text" name="other" placeholder="Hamster" />
        </div>

        <div class='field'>
            <label for='gender'>Gender</label>
                <select class="ctrl field-font" name='gender' required>
                    <option selected='true' disabled='disabled'>Select</option>
                    <option value='male'>Male</option>
                    <option value='female'>Female</option>
                </select>
        </div>

        <div class='field'>
            <label for='age'>Approximate DOB</label>
            <div>
            <input class="ctrl2 field-font" type="number" step="1" min="1" name="year" placeholder="YYYY" required/>
            <input class="ctrl2 field-font" type="number" step="1" min="1" max="12" name="month" placeholder="MM" required/>
            <input class="ctrl2 field-font" type="number" step="1" min="1" max="31" name="date" placeholder="DD" required/>
            </div>
        </div>

        <div class='field'>
            <label for='color'>Color</label>
            <input class="ctrl field-font" type="text" name="color" placeholder="Use commas to seperate colors" required/>
        </div>

        <div class="field">
            <label>Description</label>
            <textarea rows="6" class="ctrl field-font"></textarea>
            <span class="field-msg"> </span>
        </div>
        
        <div class="field ">
            <label>Upload Photo</label>
            <div class="ctrl-group field-font">
                <span class="ctrl static"><i class="fa fa-photo-video"></i></span>
                <input class="ctrl field-font" type="file" multiple />
            </div>
            <span class="field-msg"> </span>
        </div>
        <br>

        <button class='btn mr2' type='reset'>Clear</button>
        <button class='btn mr2' type="submit">Add</button>
    </form>

</div>