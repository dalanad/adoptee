<?php
$active = "consulted_animals";
require_once  __DIR__ . '/_nav.php';
?>
<script src="/assets/js/doctor.js"></script>

<table class="table row-border" style="box-shadow:var(--shadow);border-radius: 0.5rem;">
    <tr>
        <th data-field="field-1">Name</th>
        <th data-field="field-2">Owner</th>
        <th data-field="field-3">Age</th>
        <th data-field="field-4">Type</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($animals as $animal) { ?>
    <tr>
        <td><?= $animal["name"] ?></td>
        <td><?= $animal["owner_name"] ?></td>
        <td><?= $animal["age"] ?> Years</td>
        <td><?= $animal["type"] ?></td>
        <td><button class="btn btn-faded"> View</button></td>
    </tr>
    <? } ?>
</table>
<div id="output"></div>
<!-- <script>
    var source = new EventSource('/doctor/test_msg');
    source.onmessage = function(e) {
        output.innerHTML = e.data  ;
    };
</script> -->
<?php pagination($_GET["page"] ?? 0, $_GET["size"] ?? 5, 99) ?>