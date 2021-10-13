<?php
$_SESSION['name'] = $_POST["name"] ?? "";
$_SESSION['email'] = $_POST["email"] ?? ""; ?>
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
            <img src="/assets/images/logo_vector_filled.svg" style='max-width:150px; margin-bottom:1rem' />

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
                </div>

                <div class="field column">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" value="<?php echo ($_SESSION['email']); ?>" name="email" required>
                </div>
            </div>

            <div class="field column" style="width:50%;">
                <label>Mobile Phone Number</label>
                <input class="ctrl" type="text" name="telephone" pattern="07[0-9]{8}" required>
                <small class="field-hint">Format : 07XXXXXXXX</small>
            </div>

            <div class="field column">
                <label>Home Address</label>
                <input class="ctrl" type="text" name="address" required>
            </div>

            <div class="row">
                <div class="field column">
                    <label>Password</label>
                    <input class="ctrl" type="password" autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" name="password" required>
                    <small class="field-hint">Include upper & lower case letters,<br> numbers and special characters </small>
                </div>

                <div class="field column">
                    <label>Confirm Password</label>
                    <input class="ctrl" type="password" name="confirmPassword" required>
                </div>

                <?php if (isset($_GET["error"])) { ?>
                    <div style="color: red; font-weight: bold;text-align: center;margin-top: 1rem; ">
                        Passwords do not match
                    </div>
                <?php } ?>
            </div>
            <div class="field" style="margin:.5rem 0rem;">
                <div style="display:inline; font-size:0.8rem;">
                    <input class="ctrl-check" required type="checkbox">&nbsp Accept
                    <a class="btn-link bold" href="">Terms and Conditions</a>
                </div>
            </div>

            <div><button class="btn">Sign Up</button></div>

            <div class="body-text">
                <p>Already have an account?
                    <a class="btn-link bold text-decoration-none" href="/auth/sign_in">Sign in</a>
                </p>
            </div>
            </>
        </div>
</form>