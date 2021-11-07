<?php require __DIR__ . "/../../_layout/header.php"; ?>
<style>
    .adoption-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin: 1rem
    }

    .adoption-card {
        transition: background-color .5s ease-out;
        cursor: pointer;
    }

    .adoption-card-image,
    .adoption-card-details {
        border-radius: 8px;
        background: #fafafa;
        box-shadow: var(--shadow-light);
        overflow: hidden;
    }

    .adoption-card-image {
        background-size: cover;
        aspect-ratio: 1;
    }

    .adoption-card-details {
        position: relative;
    }

    .adoption-card-action {
        display: none;
        text-align: center;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 2px;
        color: white;
        font-size: 1.4em;
        position: absolute;
        background: var(--green);
        width: 100%;
        height: 100%;
    }

    .adoption-card:hover .adoption-card-action {
        display: flex;
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

    @media (max-width: 600px) {
        .filters {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            background: var(--bg);
            height: calc(100vh);
            z-index: 100;
            width: calc(100vw);
            margin: -0.5em;
            padding: 1em;
            box-sizing: border-box;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }
    }


</style>

<form class="container" style="padding:1rem 2rem;" name="_form" action="" method="get">
    <h2> Pet Adoption</h2>
    <div class="flex justify-between" style="width:100%">
        <button class="btn btn-link more-btn" onclick="//show_filters">
            <i class="fas fa-filter"></i>Filters
        </button>
    </div>
    <div style="display: flex;">
        <div style="width: 200px;" class="filters">
            <div class="field">
                <!--Gender-->
                <label>Gender</label>
                <div style="display: flex; align-items: center;  height: 2rem;">
                    <input id="male" class="ctrl-radio" type="radio" value="MALE" name="gender" onchange='_form.submit()' <?= $filter['gender'] == "MALE" ? "checked" : "" ?> />
                    &nbsp &nbsp<label for="male">Male&nbsp; </label>
                    <input id="female" class="ctrl-radio" type="radio" value="FEMALE" name="gender" onchange='_form.submit()' <?= $filter['gender'] == "FEMALE" ? "checked" : "" ?> />
                    &nbsp &nbsp<label for="female">Female&nbsp; </label>
                    <input id="any" class="ctrl-radio" type="radio" value="ANY" name="gender" onchange='_form.submit()' <?= $filter['gender'] == "ANY" ? "checked" : "" ?> />
                    &nbsp &nbsp<label for="any">Any&nbsp; </label>
                </div>

            </div>

            <div class="field">
                <!--Age-->
                <label> Age </label>
                <input type="range" min="0" max="15" value=<?= $filter['age'] != "" ? $filter['age'] : "15" ?> name="age" onchange='_form.submit()' oninput="this.nextElementSibling.value = this.value">
                <output><?= $filter['age'] ?></output>
            </div>

            <div class="field">
                <label> Animal Type </label>
                <div class="radio-box">
                    <!--animal type-->
                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type[]" class="ctrl-check" value="Dog" type="checkbox" onchange='_form.submit()' <?= in_array('Dog', $filter['animal_type']) ? "checked" : ""; ?> />
                        <label for="dog">&nbsp; <i class="far fa-dog"></i>&nbsp; Dog</label>
                    </div>

                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type[]" class="ctrl-check" value="Cat" type="checkbox" onchange='_form.submit()' <?= in_array('Cat', $filter['animal_type']) ? "checked" : ""; ?> />
                        <label for="cat">&nbsp; <i class="far fa-cat"></i>&nbsp; Cat </label>
                    </div>

                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type[]" class="ctrl-check" value="Bird" type="checkbox" onchange='_form.submit()' <?= in_array('Bird', $filter['animal_type']) ? "checked" : ""; ?> />
                        <label for="bird">&nbsp; <i class="far fa-dove"></i>&nbsp; Bird</label>
                    </div>

                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type[]" class="ctrl-check" value="Other" type="checkbox" onchange='_form.submit()' <?= in_array('Other', $filter['animal_type']) ? "checked" : ""; ?> />
                        <label for="other">&nbsp; <i class="far fa-paw"></i>&nbsp; Other </label>
                    </div>
                </div>
                <div class="field">
                    <!--Color-->
                    <label for="color"> Color </label>
                    <div class="check">
                        <input id="white" name="color[]" type="checkbox" value="White" onchange='_form.submit()' <?= in_array('White', $filter['color']) ? "checked" : ""; ?>>
                        <label for="white" style="background:cornsilk;" title="White"></label>
                        <input id="grey" name="color[]" type="checkbox" value="Grey" onchange='_form.submit()' <?= in_array('Grey', $filter['color']) ? "checked" : ""; ?>>
                        <label for="grey" style="background:grey;" title="Grey"></label>
                        <input id="orange" name="color[]" type="checkbox" value="Orange" onchange='_form.submit()' <?= in_array('Orange', $filter['color']) ? "checked" : ""; ?>>
                        <label for="orange" style="background:darkgoldenrod;" title="Orange"></label>
                        <input id="brown" name="color[]" type="checkbox" value="Brown" onchange='_form.submit()' <?= in_array('Brown', $filter['color']) ? "checked" : ""; ?>>
                        <label for="brown" style="background:brown;" title="Brown"></label>
                        <input id="black" name="color[]" type="checkbox" value="Black" onchange='_form.submit()' <?= in_array('Black', $filter['color']) ? "checked" : ""; ?>>
                        <label for="black" style="background:black;color:white;" title="Black"></label>
                    </div>
                </div>
                <div class="field">
                    <!--Org-->

                    <label> Organization </label>
                    <div class="radio-box">
                        <?php foreach ($organizations as $org) { ?>
                            <div style="margin: .5rem;display:flex">
                                <input name="organization[]" value="<?= $org["org_id"] ?>" class="ctrl-check" id="org_<?= $org["org_id"] ?>" type="checkbox" onchange='_form.submit()' <?= in_array($org["org_id"], $filter['organization']) ? "checked" : ""; ?>>
                                <label for="org_<?= $org["org_id"] ?>"> &nbsp; <?= $org["name"] ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="flex: 1 1 0;">
            <div style="margin:0 1rem;align-items:center" class="filters">
                <!--display: flex;-->
                <!--move out avail pets msg -->
                <!--sorting filters-->
                <span>Available Pets - Page 1 of 1</span> <span style="flex: 1 1 0;"></span>
                <span style="white-space: nowrap;"><i class="far fa-sort-size-up" style="font-size: 1.2em;"></i> &nbsp; Sort By : </span> &nbsp; &nbsp;
                <select class="ctrl sm" style="max-width: 7em;" name="sort" onchange='_form.submit()'>
                    <option value="date-listed" <?= $filter['sort'] == 'date-listed' ? "selected" : "" ?>>Date Listed</option>
                    <option value="age" <?= $filter['sort'] == 'age' ? "selected" : "" ?>>Age</option>
                    <option value="type" <?= $filter['sort'] == 'type' ? "selected" : "" ?>>Type</option>
                    <option value="o.name" <?= $filter['sort'] == 'o.name' ? "selected" : "" ?>>Organization</option>

                </select>&nbsp;

                <select class="ctrl sm" style="max-width: 5em;" name="order" onchange="_form.submit()">
                    <option value="desc" <?= $filter['sort'] == 'desc' ? "selected" : "" ?>>DESC</option>
                    <option value="asc" <?= $filter['sort'] == 'asc' ? "selected" : "" ?>>ASC</option>
                </select>
            </div>

            <div class="adoption-grid">
                <!--grid-->
                <?php foreach ($animals as $animal) { ?>
                    <a class="adoption-card" id=<?= $animal['type'] ?> onclick="location.href='/AdoptionRequest/view?animal_id=<?= $animal['animal_id'] ?>&org_id=<?= $animal['org_id'] ?>'">
                        <div class="adoption-card-image" style="background-image: url('<?= $animal['photo'] ?>');"></div>
                        <div class="adoption-card-details">
                            <div class="adoption-card-action">ADOPT</div>
                            <div style="display:flex; padding:.5rem 1rem;align-items: center;">
                                <div style="flex:1 1 0">
                                    <div style="font-weight: 500;"> <?= $animal["name"] ?></div>
                                    <div class="type" style="font-size:small"><?= $animal["type"] ?> - <?= round($animal["age"]) ?> years</div>
                                </div>
                                <div style="font-size: 1.5em;">
                                    <?= $animal["gender"] == 'MALE' ? '<i class="txt-clr blue fa fa-mars"></i>' : '<i class="txt-clr pink fa fa-venus"></i>' ?>
                                </div>
                            </div>
                            <div style="font-size:small;padding:.5rem 1rem;padding-top:0;color:var(--gray-5)"><i></i><?= $animal["org_name"] ?></div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</form>