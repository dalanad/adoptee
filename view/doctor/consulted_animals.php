<?php
$active = "consulted_animals";
require_once  __DIR__ . '/_nav.php';
?>

<table class="table row-border" style="border: 1px solid var(--gray-3);border-radius: 0.5rem;">
    <tr>
        <th data-field="field-1">Name</th>
        <th data-field="field-2">Owner</th>
        <th data-field="field-3">Age</th>
        <th data-field="field-4">Type</th>
        <th>Actions</th>
    </tr>
    <?php for ($i = 0; $i < 10; $i++) { ?>
        <tr>
            <td>Zeus</td>
            <td>Mr. Sumanasekara</td>
            <td>3 Years</td>
            <td>Dog</td>
            <td><button class="btn btn-faded"> Test</button></td>
        </tr>
    <? } ?>
</table>

<?php pagination($_GET["page"] ?? 0, $_GET["size"] ?? 5, 100) ?>