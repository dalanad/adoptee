<?php require __DIR__ . "./../../_layout/header.php"; ?>

<?php
    foreach($details as $key=>$value){?>
        <div><?= $value['item'];?></div>
    <?php } ?>