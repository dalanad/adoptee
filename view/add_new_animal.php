<?php
require_once  dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
// include "conn.php";
?>

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
	width: 20%;
	box-sizing: border-box;
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
    <h2 class='mt1 txt-clr'>Add New Animal for Adoption</h2>
    <form>
        <div class='field'>
            <label for='type'>Type</label>
                <select class="ctrl" name='type' required>
                    <option selected='true' disabled='disabled'>Select</option>
                    <option value='dog'>Dog</option>
                    <option value='cat'>Cat</option>
                    <option value='other'>Other</option>
                </select>
        </div>

        <div class='field other box'>
            <label for='type'>Other</label>
            <input class="ctrl" type="text" name="other" placeholder="Hamster" required/>
        </div>

        <div class='field'>
            <label for='gender'>Gender</label>
                <select class="ctrl" name='gender' required>
                    <option selected='true' disabled='disabled'>Select</option>
                    <option value='male'>Male</option>
                    <option value='female'>Female</option>
                </select>
        </div>

        <div class='field'>
            <label for='age'>Age</label>
            <div>
            
            <input class="ctrl2" type="number" step="1" min="0" name="years" placeholder="Years" required/>
            <input class="ctrl2" type="number" step="1" min="0" max="11" name="months" placeholder="Months" required/>
            <input class="ctrl2" type="number" step="1" min="0" max="3" name="months" placeholder="Weeks" required/>
            <input class="ctrl2" type="number" step="1" min="0" max="6" name="months" placeholder="Days" required/>
            </div>
        </div>

        <div class="field">
            <label>Description</label>
            <textarea rows="6" class="ctrl"></textarea>
            <span class="field-msg"> </span>
        </div>
        
        <div class="field ">
            <label>Upload Photo</label>
            <div class="ctrl-group">
                <span class="ctrl static"><i class="fa fa-photo-video"></i></span>
                <input class="ctrl" type="file" multiple />
            </div>
            <span class="field-msg"> </span>
        </div>
        <br>

        <button class='btn mr2' type='reset'>Clear</button>
        <button class='btn mr2'>Add</button>
    </form>

</div>