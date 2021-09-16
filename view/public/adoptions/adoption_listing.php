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
</style>

<div class="container" style="padding:1rem 2rem;">
    <h2> Pet Adoption</h2>
    <div style="display: flex;">
        <div style="width: 200px;">
            <div class="field">
                <label>Gender</label>
                <div style="display: flex; align-items: center;  height: 2rem;">
                    <input id=male class="ctrl-radio" type="radio" value="1" name="has_pets" />&nbsp; &nbsp;<label for="male">Male&nbsp; </label>
                    <input id="female" class="ctrl-radio" type="radio" value="0" name="has_pets" />&nbsp; &nbsp;<label for="female">Female&nbsp; </label>
                    <input id="any" class="ctrl-radio" type="radio" value="2" name="has_pets" checked />&nbsp; &nbsp;<label for="any">Any&nbsp; </label>
                </div>

            </div>
            <div class="field">
                <label> Age </label>
                <input type="range">
            </div>

            <div class="field">
                <label> Animal Type </label>
                <div class="radio-box ">
                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type" class="ctrl-check" id="dog" type="checkbox">
                        <label for="dog">&nbsp; <i class="far fa-dog"></i>&nbsp; Dog</label>
                    </div>

                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type" class="ctrl-check" id="cat" type="checkbox">
                        <label for="cat">&nbsp; <i class="far fa-cat"></i>&nbsp; Cat </label>
                    </div>

                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type" class="ctrl-check" id="bird" type="checkbox">
                        <label for="bird">&nbsp; <i class="far fa-dove"></i>&nbsp; Bird</label>
                    </div>

                    <div style="margin: .5rem;display:flex">
                        <input name="animal_type" class="ctrl-check" id="other" type="checkbox">
                        <label for="other">&nbsp; <i class="far fa-paw"></i>&nbsp; Other </label>
                    </div>
                </div>
                <div class="field">
                    <label> Color </label>
                    <input type="color">
                </div>
                <div class="field">
                    <label> Organization </label>
                    <div class="radio-box ">
                        <?php foreach ($organizations as $org) { ?>
                            <div style="margin: .5rem;display:flex">
                                <input name="organizations" value="<?= $org["org_id"] ?>" class="ctrl-check" id="org_<?= $org["org_id"] ?>" type="checkbox">
                                <label for="org_<?= $org["org_id"] ?>"> &nbsp; <?= $org["name"] ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="flex: 1 1 0;">
            <div style="display: flex;margin:0 1rem;align-items:center">
                <span>Available Pets - Page 1 of 1</span> <span style="flex: 1 1 0;"></span>
                <span style="white-space: nowrap;"><i class="far fa-sort-size-up" style="font-size: 1.2em;"></i> &nbsp; Sort By : </span> &nbsp; &nbsp;
                <select class="ctrl sm" style="max-width: 7em;">
                    <option>Age</option>
                    <option>Type</option>
                    <option>Organization</option>
                </select>&nbsp;
                <select class="ctrl sm" style="max-width: 5em;">
                    <option>ASC</option>
                    <option>DESC</option>
                </select>
            </div>
            <div class="adoption-grid">
                <?php foreach ($animals as $animal) { ?>
                    <a class="adoption-card" onclick="location.href='/AdoptionRequest/view?animal_id=<?= $animal['animal_id'] ?>'">
                        <div class="adoption-card-image" style="background-image: url('<?= $animal['photo'] ?>');"></div>
                        <div class="adoption-card-details">
                            <div class="adoption-card-action">ADOPT</div>
                            <div style="display:flex; padding:.5rem 1rem;align-items: center;">
                                <div style="flex:1 1 0">
                                    <div style="font-weight: 500;"><?= $animal["name"] ?></div>
                                    <div style="font-size:small"><?= $animal["type"] ?> - <?= round($animal["age"]) ?> years</div>
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