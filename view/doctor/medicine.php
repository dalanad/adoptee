<?php
$active = "medicine";
require_once  __DIR__ . '/_nav.php';
?>

<a class="btn" style="float: right;margin-bottom: 1rem " href="/Doctor/medicine_single?medicine_id=new"> New Medicine</a>

<table class="table row-border" style="box-shadow:var(--shadow);border-radius: 0.5rem; padding  :.5rem 1rem">
    <tr>
        <th data-field="name">Name</th>
        <th>EDIT</th>
    </tr>
    <?php foreach ($medicines as $medicine) { ?>
        <tr>
            <td><?= $medicine["name"] ?></td>
            <td><a class="btn btn-faded" href="/Doctor/medicine_single?medicine_id=<?= $medicine["medicine_id"] ?>"><i class="fas fa-edit"></i>&nbsp; Edit</a></td>
        </tr>
    <?php } ?>
</table>