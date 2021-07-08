<?php
require_once  dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php"
// include "conn.php";
?>

<div class='container px2'>
    <div class='placeholder-box mr1' style='height:50px; width:100px;'>Logo</div>
    <h2 class='mt1 txt-clr'>Add New Animal for Adoption</h2>
    <form>
        <div class='field'>
            <label for='type'>Type</label>
            <input class="ctrl" type="text" name="type" placeholder="Dog" required/>
        </div>

        <div class='field'>
            <label for='gender'>Gender</label>
            <input class="ctrl" type="text" name="gender" placeholder="Male / Female" required/>
        </div>

        <div class='field'>
            <label for='age'>Age</label>
            <div>
            <label for='years'>Years</label>
            <input class="ctrl" type="number" step="1" min="0" name="years" placeholder="Years" required/>
            <label for='months'>Months</label>
            <input class="ctrl" type="number" step="1" min="0" max="11" name="months" placeholder="Months" required/>
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

        <button class='btn mr2' type='reset'>Clear All</button>
        <button class='btn mr2'>Add</button>
    </form>

</div>