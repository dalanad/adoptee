<style>
    .heading {
        flex: 40%;
        padding-bottom: 0.2rem;
        font-weight: bold;
    }

    .time {
        color: grey;
        font-weight: bold;
        font-size: small;
    }

    .criteria {
        font-size: 0.8rem;
        margin-right: 1rem;
    }

    .fa-star {
        color: var(--gray-3);
    }

    .checked,
    .fa-star-half {
        color: orange;
    }
</style>

<?php
foreach ($reviews as $key => $value) {
    $overall_rate = ($value["living_conditions"] + $value["healthcare"] + $value["rescue_response"] + $value["adoptions"] + $value["resource_allocation"]) / 5;
?>
    <div class="card mb2" style="max-width:40rem;">

        <div style="display:flex;">
            <div class="heading"><?= $value['name'] == "1" ? $value['u_name'] : 'Anonymous User'; ?></div>

            <!-- stars for overall rating -->
            <div style="font-size:.9rem;flex:60%">
                <?php for ($i = 0; $i < round($overall_rate); $i++) { ?>
                    <span class="fa fa-star checked"></span>
                <?php }
                if ($overall_rate - round($overall_rate) > 0) { ?>
                    <span class="fas fa-star-half"></span>
                <?php }
                for ($i = 0; $i < 5 - ceil($overall_rate); $i++) { ?>
                    <span class="far fa-star"></span>
                <?php } ?>
            </div>
        </div>

        <!-- date -->
        <div class="time">
            <?= explode(" ", $value["created_time"])[0] ?>
        </div>

        <!-- comments -->
        <div class="mb2 mt2" style="flex:60%;">
            <?= $value["comments"] ?>
        </div>

    </div>
<?php } ?>