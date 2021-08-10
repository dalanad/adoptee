<?php require __DIR__ . "./../../_layout/header.php"; ?>
<style>
    .report {
        display: grid;
        margin: 0rem 1rem 3rem 1rem;
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
            height: 100%;
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
</style>

<div class="container ctx">
    <div class="report">

        <div class='field'>
            <div class = "row">
                <div class = "column">Name of adopter:</div>
                <div class = "column">Hiruni Dahanayake</div>
            </div>

            <?php /*Fetch name of adopter and display*/ ?>

        </div>

        <div class='field'>
            <div class = "row">
                <div class = "column">Contact Number:</div>
                <div class = "column">071 1234 123</div>
            </div>
            
            <?php /*Fetch contact number of adopter and display*/?>

        </div>

        <!-- temporary image -->
        <div class="rounded" id="image">
            <img style="border-radius:8px;max-height: 450px;margin:0 auto" 
            src="/assets/images/dogs/placeholder0.jpg" />
        </div>

        <div class='field'>
            <div class = "row">
                <div class = "column">Email:</div>
                <div class = "column">hiruni@gmail.com</div>
            </div>

            <?php /*Fetch email address of adopter and display*/ ?>
            
        </div>

        <div class='field'>
            <div class = "row">
                <div class = "column">Address:</div>
                <div class = "column">No 5, 5th Lane, Colombo 5</div>
            </div>

            <?php /*Fetch address of adopter and display*/ ?>
            
        </div>

        <p style="color:#ff0000; font-size:15px;">*If your personal details are incorrect, 
        please visit your profile and update them</p>

        <div class='field'>
                <div class = "row">
                    <div class = "column">
                        <label for="has_pets">Do you own any pets?</label>
                    </div>
                    <div class = "column">
                        Yes <input class="ctrl-check" type="radio" value="yes" name="has_pets" />
                        No <input class="ctrl-check" type="radio" value="no" name="has_pets" />
                    </div>
                </div>
        </div>

        <div class='field'>
            <div class = "row">
                <div class = "column">
                    <label for="petsafety">If "Yes", would it be safe for the requested pet to 
                        live in the same household?
                    </label>
                </div>
                <div class = "column">
                    <textarea rows = "4" class="ctrl" name="petsafety"></textarea>
                </div>
            </div>
        </div>

    </br>

        <div class='field'>
            <div class = "row">
                <div class = "column">
                    <label for="children">Are there children living in the same household?</label>
                </div>
                <div class = "column">
                    Yes <input class="ctrl-check" type="radio" value="yes" name="children" />
                    No <input class="ctrl-check" type="radio" value="no" name="children" />
                </div>
            </div>
        </div>

        <div class='field'>
            <div class = "row">
                <div class = "column">
                    <label for="childsafety">If "Yes", would it be safe for the requested pet to 
                        live in the same household?
                    </label>
                </div>
                <div class = "column">
                    <textarea rows = "4" class="ctrl" name="childsafety"></textarea>
                </div>
            </div>
        </div>

    </br>

        <div><button class='btn mr2'>Send request</button></div>
    </div>
</div>