<?php require __DIR__ . "./../../_layout/header.php" ?>

<style>
    .report {
        display: grid;
        margin: 0rem 1rem 3rem 1rem;
        overflow: scroll;
    }

    @media (min-width:780px) {
        .report {
            grid-template-columns: 1fr 1fr;
            column-gap: 1rem;
            margin: 2rem;
        }

        #image {
            grid-column: 1;
            grid-row: 1 / span 10;
            height: 50%;
        }

        #details{
            grid-column: 1;
            grid-row: 11 / span 10;
            height: 50%;
        }
    }

    @media (min-width:1200px) {
        .ctx {
            height: calc(100% - 150px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    }

    .row {
        display: flex;
    }

    .column {
        flex: 50%;
    }

    .message{
        display: block;
        margin-top: 25%;
        margin-left: 20%;
        color: var(--primary);
    }
</style>

<form class="container ctx" action="/AdoptionRequest/submit" method="POST">

    <div class="report">

        <!-- temporary image -->
        <div class="rounded" id="image">
            <img style="border-radius:8px;max-height: 350px;margin:0 auto" src="/assets/images/dogs/placeholder0.jpg" />
        </div>

        <?php if (isset($_SESSION['user'])) { ?>

            <div class='field'>
                <div class="row">
                    <div class="column">Name of adopter:</div>
                    <div class="column"><?php print_r($_SESSION['user']['name']); ?></div>
                </div>
            </div>

            <div class='field'>
                <div class="row">
                    <div class="column">Contact Number:</div>
                    <div class="column"><?php print_r($_SESSION['user']['telephone']); ?></div>
                </div>
            </div>

            <div class='field'>
                <div class="row">
                    <div class="column">Email:</div>
                    <div class="column"><?php print_r($_SESSION['user']['email']); ?></div>
                </div>
            </div>

            <div class='field'>
                <div class="row">
                    <div class="column">Address:</div>
                    <div class="column"><?php print_r($_SESSION['user']['address']); ?></div>
                </div>
            </div>

            <p style="color:#ff0000; font-size:15px;">*If your personal details are incorrect,
                please visit your profile and update them</p>

            <div class='field'>
                <div class="row">
                    <div class="column">
                        <label for="has_pets">Do you own any pets?</label>
                    </div>
                    <div class="column">
                        Yes <input class="ctrl-check" type="radio" value="1" name="has_pets" />
                        No <input class="ctrl-check" type="radio" value="0" name="has_pets" />
                    </div>
                </div>
            </div>

            <div class='field'>
                <div>
                    </br>
                    <label for="petsafety">If "Yes", what are the any safety concerns with adopting the requested pet, if any?
                    </label>
                </div>
                <div>
                    <textarea rows="4" class="ctrl" name="petsafety"></textarea>
                </div>
            </div>

            </br>

            <div class='field'>
                <div class="row">
                    <div class="column">
                        <label for="children">Are there children living in the same household?</label>
                    </div>
                    <div class="column">
                        Yes <input class="ctrl-check" type="radio" value="1" name="children" />
                        No <input class="ctrl-check" type="radio" value="0" name="children" />
                    </div>
                </div>
            </div>

            <div class='field'>
                <div>
                    </br>
                    <label for="childsafety">If "Yes", what are the any safety concerns with adopting the requested pet, if any?
                    </label>
                </div>
                <div>
                    <textarea rows="4" class="ctrl" name="childsafety"></textarea>
                </div>
            </div>

            <div id="details">
                <?php print_r($data) ?>
            </div>
            <!-- description -->

            <div><button class='btn mr2'>Send request</button></div>
        <?php } else { ?>
            <div class="message">Please login to continue</div>
        <?php } ?>
    </div>
</form>