<?php session_start();
$_SESSION['name'] = $_POST["name"];
$_SESSION['email'] = $_POST["email"]; ?>
<?php require_once __DIR__ . "./../_layout/layout.php" ?>

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


<form class="centered-container" action="/ProfileController/sign_up" method="POST">
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
                    <input class="ctrl" type="text" value="<?php echo ($_SESSION['name']); ?>">
                    <span class="field-msg"></span>
                </div>

                <div class="field column">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" value="<?php echo ($_SESSION['email']); ?>">
                    <span class="field-msg"></span>
                </div>
            </div>

            <div class="field column" style="width:50%;">
                <label>Telephone</label>
                <input class="ctrl" type="text">
                <span class="field-msg"></span>
            </div>

            <div class="field column">
                <label>Home Address</label>
                <input class="ctrl" type="text">
                <span class="field-msg"></span>
            </div>

            <div class="row">
                <div class="field column">
                    <label>Password</label>
                    <input class="ctrl" type="password">
                    <span class="field-msg"></span>
                </div>

                <div class="field column">
                    <label>Confirm Password</label>
                    <input class="ctrl" type="password">
                    <span class="field-msg"></span>
                </div>
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