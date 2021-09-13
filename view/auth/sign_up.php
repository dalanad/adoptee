<?php
$_SESSION['name'] = $_POST["name"];
$_SESSION['email'] = $_POST["email"]; ?>
<?php require_once __DIR__ . "/../_layout/layout.php" ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">

<style>
    .row {
        display: flex;
    }

    .column {
        margin-right: 1rem;
        flex: 50%;
    }
</style>


<form class="centered-container" action="/Auth/process_sign_up" method="POST">
    <div class="card-container">
        <div>

            <div class="body-text">
                <p class="m0">Welcome to Adoptee</p>
            </div>

            <div class="title-text">
                <label style="font-size:1.5rem;">Sign Up</label>
            </div>

            <div class="row">
                <div class="field column">
                    <label>Name</label>
                    <input class="ctrl" type="text" value="<?php echo ($_SESSION['name']); ?>" name="name" required>
                    <span class="field-msg"></span>
                </div>

                <div class="field column">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" value="<?php echo ($_SESSION['email']); ?>" name="email" required>
                    <span class="field-msg"></span>
                </div>
            </div>

            <div class="field column" style="width:50%;">
                <label>Mobile Phone Number</label>
                <input class="ctrl" type="text" name="telephone" pattern="[0-9]{10}/" required>
                <span class="field-msg"></span>
            </div>

            <div class="field column">
                <label>Home Address</label>
                <input class="ctrl" type="text" name="address" required>
                <span class="field-msg"></span>
            </div>

            <div class="row">
                <div class="field column">
                    <label>Password</label>
                    <input class="ctrl" type="password" name="password" required>
                    <span class="field-msg"></span>
                </div>

                <div class="field column">
                    <label>Confirm Password</label>
                    <input class="ctrl" type="password" name="confirmPassword" required>
                    <span class="field-msg"></span>
                </div>

                <?php if (isset($_GET["error"])) { ?>
                    <div style="color: red; font-weight: bold;text-align: center;margin-top: 1rem; ">
                        Passwords do not match
                    </div>
                <?php } ?>
            </div>

            <div class="field" style="display:inline; font-size:0.8rem">
                <input class="ctrl-check mb2" type="checkbox">&nbsp Accept
                <a class="btn-link bold mb2" href="">Terms and Conditions</a>
            </div>

            <div><button class="btn">Sign Up</button></div>

            <div class="body-text">
                <p>Already have an account?
                    <a class="btn-link bold text-decoration-none" href="./sign_in.php">Sign in</a>
                </p>
            </div>



        </div>
    </div>
    </div>