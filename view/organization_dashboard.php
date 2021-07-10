<?php
require_once  dirname(__FILE__) .'./_layout/layout.php';

$data["header"]["nav"] = false;
$data["user"] = "Dalana";

require  dirname(__FILE__) ."./_layout/header.php";
?>

<style>

</style>

<div class="container">
    <div class="m2 flex justify-between items-end">
        <div>
            <div style="font-size: .8em;"> Tails of Freedom </div>
            <h2 class="m0"> Dashboard </h2>
        </div>
        <a href="/view/organization_settings.php" class="btn btn-link btn-icon"><i class="fa fa-cog mr1"></i>Settings</a>
    </div>

</div>

