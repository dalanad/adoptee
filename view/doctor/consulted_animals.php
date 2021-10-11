<?php
$active = "consulted_animals";
require_once  __DIR__ . '/_nav.php';
?>
<form method="get" action="" id="f_form" style="display: flex;align-items:center;margin-bottom:1rem">
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
    <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="<?= $filter["search"] ?>">
    <button class="btn outlined">Search</button>
</form>

<table class="table row-border" style="box-shadow:var(--shadow);border-radius: 0.5rem; padding  :.5rem 1rem">
    <tr>
        <th style="width: 1px;"> </th>
        <th data-field="name">Name</th>
        <th data-field="owner_name">Owner</th>
        <th data-field="type">Type</th>
        <th data-field="gender">Gender</th>
        <th data-field="age">Age</th>
        <th data-field="last_consultation">Last Consultation</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($animals as $animal) { ?>
        <tr>
            <td>
                <div class="animal-image" style="height:30px;width:30px;background-image:url('<?= $animal["photo"] ?>');"> </div>
            </td>
            <td><?= $animal["name"] ?></td>
            <td><?= $animal["owner_name"] ?></td>
            <td><?= $animal["type"] ?></td>
            <td><?= $animal["gender"] ?></td>
            <td><?= $animal["age"] ?> Years</td>
            <td><?= $animal["last_consultation"] ?></td>
            <td><a class="btn btn-faded" href="/Doctor/animal_history/<?= $animal["animal_id"] ?>"><i class="fas fa-eye"></i>&nbsp; View</a></td>
        </tr>
    <?php } ?>
</table>
<?php pagination($filter["page"], $filter["size"], $count) ?>