<style>
    .box {
        width: 40rem;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: var(--shadow);
        margin: 1rem 1rem 1rem 0rem;
    }
</style>

<div class="box">
        <div><?= $details[0]['about']; ?></div>
        <div style="margin-top:4rem;">
            <?php
                $telephone = "Contact us at ".$details[0]['telephone']."";
                $address = "".$details[0]['address_line_1']." , ".$details[0]['address_line_2'].", ".$details[0]['city']."";
                echo "".$telephone." <br>";
                print_r($address);
            ?>
            <div class="rounded" style="height:40px;width:40px;" id="googleMap"></div>
        </div>
</div>