<style>
    .heading {
        flex: 20%;
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
    $rate = array("Very Low", "Low", "Neutral", "Good", "Very Good");
    $overall_rate = ($value["living_conditions"] + $value["healthcare"] + $value["rescue_response"] + $value["adoptions"] + $value["resource_allocation"]) / 5;
?>
    <div class="card mb2">

        <div style="display:flex;">
            <div class="heading"><?= $value['name'] == "1" ? $value['u_name'] : 'Anonymous User'; ?></div>

            <!-- stars for overall rating -->
            <div style="font-size:.9rem;flex:80%">
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

        <div style="display: flex; margin-top:1rem;">

            <!-- comments -->
            <div class="mb2" style="flex:60%; margin-right:5rem;">
                <?= $value["comments"] ?>
            </div>

            <!-- criteria individual ratings -->
            <div style="display:flex;flex:40%;">
                <div class="criteria">
                    <div>Pet Living Conditions</div>
                    <div>Pet Healthcare</div>
                    <div>Rescue Report Handling</div>
                    <div>Adoption Request Response</div>
                    <div>Resource Allocation</div>
                </div>
                <div style="font-size:0.8rem;">
                    <div><?= $value["living_conditions"]!=0? $rate[$value["living_conditions"] - 1] : "-" ?></div>
                    <div><?= $value["living_conditions"]!=0? $rate[$value["healthcare"] - 1] : "-" ?></div>
                    <div><?= $value["living_conditions"]!=0? $rate[$value["rescue_response"] - 1] : "-" ?></div>
                    <div><?= $value["living_conditions"]!=0? $rate[$value["adoptions"] - 1] : "-" ?></div>
                    <div><?= $value["living_conditions"]!=0? $rate[$value["resource_allocation"] - 1] : "-" ?></div>
                </div>
            </div>
        </div>

    </div>
<?php } ?>