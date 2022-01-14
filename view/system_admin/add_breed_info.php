<?php require __DIR__ . "/../_layout/layout.php" ?>

<style>
    .field {
        margin-right: 2rem;
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

    .ctrl-group {
        justify-content: space-between;
        margin-top: 1rem;
    }

    .radio-set {
        display: flex;
        flex-direction: column;
    }
</style>

<header class="header">
    <div class="logo">
        <img src="/assets/images/logo_vector_filled.svg" />
    </div>
    <?= user_btn() ?>
</header>

<div class="container">
    <div style="text-align:center;margin-bottom:2rem;">
        <h3>Breed Information</h3>
        <img src="/assets/images/graphics/holding_cat.jpg" alt="person with cat" style="height: 180px;" />
    </div>

    <form action="/Adoptions/processBreedInfo" method="post" enctype="multipart/form-data">

        <div style="display: flex;" class="mb2">
            <div class="field">
                <label for="type">Type: </label>
                <select class="ctrl select" name="type" id="type" onchange="petType(this);" required>
                    <option>Dog</option>
                    <option>Cat</option>
                </select>
            </div>
            <div class="field">
                <label for="breed">Breed: </label>
                <input type="text" class="ctrl" name="breed" id="breed" required />
            </div>
            <div class="field" style="display:inline;width:6rem;">
                <label for="height">Height:</label>
                    <input type="number" step="0.1" min="0.10" max="1.10" class="ctrl" name="height" id="height" required /> meters
            </div>
            <div class="field" style="display:inline;width:6rem;">
                <label for="weight">Weight:</label>
                    <input type="number" step="0.1" min="0.40" max="115.00" class="ctrl" name="weight" id="weight" required />kg
            </div>
            </br>
            <div class="field" style="display:inline;width:8rem;">
                <label for="life-expectancy">Life-expectancy:</label>
                    <input type="number" step="1" min="10" max="13" class="ctrl" name="life-expectancy" id="life-expectancy" required /> years
            </div>
            <div class="field">
                <label for="color"> Color </label>
                <div class="check">
                    <input id="white" name="color[]" type="checkbox" value="White" required>
                    <label for="white" style="background:cornsilk;" title="White"></label>
                    <input id="grey" name="color[]" type="checkbox" value="Grey">
                    <label for="grey" style="background:grey;" title="Grey"></label>
                    <input id="orange" name="color[]" type="checkbox" value="Orange" ?>
                    <label for="orange" style="background:darkgoldenrod;" title="Orange"></label>
                    <input id="brown" name="color[]" type="checkbox" value="Brown">
                    <label for="brown" style="background:saddlebrown;" title="Brown"></label>
                    <input id="black" name="color[]" type="checkbox" value="Black">
                    <label for="black" style="background:black;color:white;" title="Black"></label>
                </div>
            </div>
        </div>

        <div style="display: flex;" class="mb2">
            <div class="field" style="flex:50%;">
                <label for="photo">Photo:</label>
                <input type="file" class="ctrl" name="photo" id="photo" required />
            </div>

            <div class="field" style="flex:50%;">
                <label for="child_friendly">Child-friendliness: </label>
                <div class="ctrl-group">
                    <div class="radio-set">
                        <input type="radio" class="ctrl-radio" name="child_friendly" id="very-low" value="very-low" required>
                        <label for="very-low">Very Low</label>
                    </div>
                    <div class="radio-set">
                        <input type="radio" class="ctrl-radio" name="child_friendly" id="low" value="low">
                        <label for="low">Low</label>
                    </div>
                    <div class="radio-set">
                        <input type="radio" class="ctrl-radio" name="child_friendly" id="average" value="average">
                        <label for="average">Average</label>
                    </div>
                    <div class="radio-set">
                        <input type="radio" class="ctrl-radio" name="child_friendly" id="good" value="good">
                        <label for="good">Good</label>
                    </div>
                    <div class="radio-set">
                        <input type="radio" class="ctrl-radio" name="child_friendly" id="very-good" value="very-good">
                        <label for="very-good">Very Good</label>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;" class="mb2">
            <div class="field" style="flex:50%;">
                <label for="pet_friendly">Co-existence with other pets: </label>
                <textarea class="ctrl" name="pet_friendly" id="pet_friendly" cols="50" rows="6" required></textarea>
            </div>

            <div class="field" style="flex:50%;">
                <label for="health">Health Issues: </label>
                <textarea class="ctrl" name="health" id="health" cols="50" rows="6" required></textarea>
            </div>
        </div>

        <div class="field" style="width: 50%;">
                <label for="problems">Problems to look for: </label>
                <textarea class="ctrl" name="problems" id="problems" cols="50" rows="6" required></textarea>
            </div>

        <input type="submit" value="Save" class="btn"/>
    </form>
</div>

<script>
    function petType(_select)
    {
        var pet = _select.options[_select.selectedIndex].value;
        var height = document.getElementById('height');
        var weight = document.getElementById('weight');
        var life_expectancy = document.getElementById('life-expectancy');
        
        if(pet=="Cat"){
            height.max="1.80";height.min="0.15";
            weight.max="11.00";weight.min="3.60";
            life_expectancy.max="18";life_expectancy.min="12";
        }
        else{
            height.max="1.10";height.min="0.10";
            weight.max="115.0";weight.min="0.40";
            life_expectancy.max="13";life_expectancy.min="10";
        }
    }
</script>