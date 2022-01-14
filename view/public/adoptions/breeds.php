<?php require __DIR__ . "/../../_layout/header.php" ?>

<style>
    .row {
        display: flex;
        margin-bottom: 2rem;
        align-items: center;
    }

    .column {
        flex: 50%;
    }

    .cell {
        display: flex;
        gap: 2rem;
    }

    img {
        max-width: 30rem;
        max-height: 30rem;
        width: auto;
        height: auto;
        border-radius: 8px;
    }

    form {
        margin: 3rem;
    }
</style>

<div style="text-align:center;margin-bottom:2rem;">
    <h3>Breed Information</h3>
</div>

<!-- ?php print_r($filter); ?> -->

<form action="" method="GET" name="filter">
    <span style="white-space: nowrap;"><i class="fas fa-paw" style="font-size: 1.2em;"></i> &nbsp; Type </span>&nbsp;
    <select class="ctrl sm" style="max-width: 8em;" name="type" onchange='filter.submit()'>
        <option value="select" <?= $filter['type'] == "DOG" ? "selected" : "" ?> selected disabled>Select</option>
        <option value="DOG" <?= $filter['type'] == "DOG" ? "selected" : "" ?> onchange='filter.submit();'>Dogs</option>
        <option value="CAT" <?= $filter['type'] == "CAT" ? "selected" : "" ?> onchange='filter.submit();'>Cats</option>
    </select>&nbsp;
    <span style="white-space: nowrap; margin-left:2rem;">Breed</span> &nbsp;
    <select class="ctrl sm" style="max-width: 8em;" name="breed" onchange='filter.submit()'>
        <option value="select" disabled <?= $filter['type'] == "select" ? "selected" : "" ?>>Select</option>
        <?php foreach ($selections as $key => $value) {
            if ($value['type'] == $filter['type']) { ?>
                <!-- display only the selected type's breeds -->
                <option value="<?= $value['breed'] ?>" <?= $filter['breed'] == $value['breed'] ? "selected" : "" ?>><?= $value['breed'] ?></option>
        <?php }
        } ?>
    </select>&nbsp;
</form>

<?php if (isset($info) && sizeof($info) > 0) {
    $info = $info[0]; ?>

    <div class="container">
        <div class="cell">
            <div style="flex: 1;">
                <img src="<?= $info['photo'] ?>" />
            </div>
            <div style="flex: 1;">
                <div class="row">
                    <div class="column bold">Breed</div>
                    <div class="column"><?= $info['breed'] ?></div>
                </div>
                <div class="row">
                    <div class="column bold">Height</div>
                    <div class="column"><?= $info['height'] ?> m</div>
                </div>
                <div class="row">
                    <div class="column bold">Weight</div>
                    <div class="column"><?= $info['weight'] ?> kg</div>
                </div>
                <div class="row">
                    <div class="column bold">Life-expectancy</div>
                    <div class="column"><?= $info['life_expectancy'] ?> years</div>
                </div>
                <div class="row">
                    <div class="column bold">Colour</div>
                    <div class="column"><?= $info['color'] ?></div>
                </div>
                <div class="row mb2">
                    <div class="column bold">Child-friendliness</div>
                    <div class="column"><?= $info['child_friendly'] ?></div>
                </div>
                <div class="row">
                    <div class="column bold">Co-existence with other pets</div>
                    <div class="column"><?= $info['pet_friendly'] ?></div>
                </div>
                <div class="row">
                    <div class="column bold">Health Issues</div>
                    <div class="column"><?= $info['health'] ?></div>
                </div>
                <div class="row">
                    <div class="column bold">Problems to look for</div>
                    <div class="column"><?= $info['problems'] ?></div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <div style="text-align: center;">
        <h2 style="margin-top: 2em;color:var(--green)">Select the animal type and breed to view details</h2>
        <img src="/assets/images/choose_pet.jpg" style="height: 180px;" />
    </div>
<?php } ?>

<script>
    //     function changeBreeds() {
    //         // var type = document.getElementsByTagName('select')[0];
    //         var breed = document.getElementsByTagName('select')[1];
    //         breed.children[0].selected=true;
    //     }
    // 
</script>