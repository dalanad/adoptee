<?php
$active = "consulted_animals";
require_once  __DIR__ . '/_nav.php';
?>
<form method="get" action="" id="f_form" style="display: flex;align-items:center;margin-bottom:1rem;flex-wrap:wrap;line-height:2rem">
    <div style="white-space: nowrap;">
        <b>Gender :</b> &nbsp;
        <input class="ctrl-radio" type="radio" onchange="f_form.submit()" name="gender" <?= $filter["gender"] == "Male" ? "checked" : "" ?> value="Male" /> Male
        <input class="ctrl-radio" type="radio" onchange="f_form.submit()" name="gender" <?= $filter["gender"] == "Female" ? "checked" : "" ?> value="Female" /> Female
        <input class="ctrl-radio" type="radio" onchange="f_form.submit()" name="gender" <?= $filter["gender"] == "Any" ? "checked" : "" ?> value="Any" /> Any
    </div> &nbsp; | &nbsp;
    <div style="white-space: nowrap;">
        <b>Animal Type :</b> &nbsp;
        <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="type[]" <?= in_array("dog", $filter["type"]) ? "checked" : "" ?> value="dog" /> Dog
        <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="type[]" <?= in_array("cat", $filter["type"]) ? "checked" : "" ?> value="cat" /> Cat
        <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="type[]" <?= in_array("bird", $filter["type"]) ? "checked" : "" ?> value="bird" /> Bird
        <input class="ctrl-check" type="checkbox" onchange="f_form.submit()" name="type[]" <?= in_array("other", $filter["type"]) ? "checked" : "" ?> value="other" /> Other
    </div>
    <span style="flex:1 1 0"></span>
    <div style="white-space: nowrap; flex: 1 1 0; text-align: right;">
        <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="<?= $filter["search"] ?>">
        <button class="btn outlined"> <i class="far fa-search"></i>&nbsp; Search</button>
    </div>

</form>
<div style="overflow-x:auto;">
    <table class="table row-border animal-table">
        <tr>
            <th class="hidden-md" style="width: 1px;"> </th>
            <th data-field="name">Animal</th>
            <th class="hidden-md" data-field="owner_name">Owner</th>
            <th class="hidden-md" data-field="type">Type</th>
            <th class="hidden-md" data-field="gender">Gender</th>
            <th class="hidden-md" data-field="age">Age</th>
            <th class="hidden-md" data-field="last_consultation">Last Consultation</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($animals as $animal) { ?>
            <tr>
                <td class="hidden-md">
                    <div class="animal-image" style="height:30px;width:30px;background-image:url('<?= $animal["photo"] ?>');"> </div>
                </td>
                <td class="only-md">
                    <div style="display:flex">
                        <img src="<?= $animal["photo"] ?>" style="height:80px;border-radius:.3rem">
                        <div style="width:10rem;margin-left:.5rem">
                            <b><?= $animal["name"] ?></b> <i class="far fa-<?= strtolower($animal["type"]) ?>"></i>
                            <div style="margin: 0.2em 0;" class="owner-name"><?= $animal["owner_name"] ?></div>
                            <small><?= strtoupper($animal["type"]) ?> : <?= $animal["gender"] ?> - <?= $animal["age"] ?> Years</small>
                            <br><small>Last Consult : <?= $animal["last_consultation"] ?></small>
                        </div>
                    </div>
                </td>
                <td class="hidden-md"><?= $animal["name"] ?></td>
                <td class="hidden-md"><?= $animal["owner_name"] ?></td>
                <td class="hidden-md"><?= strtoupper($animal["type"]) ?></td>
                <td class="hidden-md"><?= $animal["gender"] ?></td>
                <td class="hidden-md"><?= $animal["age"] ?> Years</td>
                <td class="hidden-md"><?= $animal["last_consultation"] ?></td>
                <td><a class="btn btn-faded" href="/Doctor/animal_history/<?= $animal["animal_id"] ?>"><i class="fas fa-eye"></i>&nbsp; View</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php pagination($filter["page"], $filter["size"], $count) ?>
<style>
    .animal-table {
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        padding: .5rem 1rem
    }

    .only-md {
        display: none;
    }

    @media screen and (max-width:800px) {
        .hidden-md {
            display: none;
        }

        .only-md {
            display: table-cell;
        }

        .animal-table {
            box-shadow: none;
            padding: 0rem
        }

        .table:not(.no-pad) td:first-child,
        .table:not(.no-pad) th:first-child {
            padding-left: 0rem;
        }
    }
</style>