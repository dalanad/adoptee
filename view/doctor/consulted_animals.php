<?php
$active = "consulted_animals";
require_once  __DIR__ . '/_nav.php';
?>
<div style="display: flex;margin:0 1rem;align-items:center;margin-bottom:1rem;margin-top:-1rem">
    <b>Filters - </b>
    &nbsp;
    Type :&nbsp; <select onchange="params({ type: this.value },false)" class="ctrl sm" style="max-width: 5em;">
        <option>ANY</option>
        <option>DOG</option>
        <option>CAT</option>
        <option>BIRD</option>
        <option>OTHER</option>
    </select>
    &nbsp; Name :&nbsp; <input class="ctrl sm" style="max-width: 10em;" />
    <span style="flex: 1 1 0;"></span>
</div>
<table class="table row-border" style="box-shadow:var(--shadow);border-radius: 0.5rem; padding  :.5rem 1rem">
    <tr>
        <th style="width: 1px;"> </th>
        <th data-field="name">Name</th>
        <th data-field="owner">Owner</th>
        <th data-field="type">Type</th>
        <th data-field="gender">Gender</th>
        <th data-field="age">Age</th>
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
            <td><button class="btn btn-faded"><i class="fas fa-eye"></i>&nbsp; View</button></td>
        </tr>
    <? } ?>
</table>
<?php pagination($_GET["page"] ?? 0, $_GET["size"] ?? 5, 99) ?>