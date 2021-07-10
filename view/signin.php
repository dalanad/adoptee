<?php require_once  __DIR__ . './_layout/layout.php' ?>
<?php $active = isset($_GET["active"]) ? $_GET["active"] : "signin"; ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">

<div class="centered-container">
    <div style="padding: .5em;">
        <div class="card-container">
            <div class="animated-card <?= $active == 'signin' ? "hidden" : '' ?>" id="sign-up">
                <div>Welcome to Adoptee</div>
                <div class="title-text">Sign Up</div>
                <div class="field">
                    <label>Name</label>
                    <input class="ctrl" type="email" />
                    <span class="field-msg"></span>
                </div>
                <div class="field">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" />
                    <span class="field-msg"> </span>
                </div>
                <button class="btn">Register</button>
                <div class="body-text">
                    Alreaday have an account ? <a class="btn btn-link" style="font-size:1em;padding:0" onclick="SignIn()">Sign In </a>
                </div>
                <div style="margin-top: 1rem;">
                    <div class="body-text">Register as</div>
                    <a class="btn outline green" href="/view/auth/organization_signup.php"> <i class="fa fa-hand-holding-heart"></i>&nbsp;Organization</a>
                    <button class="btn outline pink"> <i class="fa fa-user-md"></i>&nbsp;Doctor</button>
                </div>
            </div>
            <div class="spacer-card"></div>
            <div class="animated-card <?= $active == 'signup' ? "hidden" : '' ?>" id="sign-in">
                <div>Welcome to Adoptee</div>
                <div class="title-text">Sign In</div>
                <div class="field">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" />
                    <span class="field-msg"> </span>
                </div>
                <div class="field">
                    <label ondblclick="show()">Password</label>
                    <input class="ctrl" type="password" />
                    <a href="#" class="field-msg"> Forgot Password ? </a>
                </div>
                <a class="btn" style="margin: 1em 0;" href="/view/home.php">Sign In</a>
                <div class="body-text">
                    Don't have an account ? <a class="btn btn-link" style="font-size:1em;padding:0" onclick="SignUp()">Sign Up </a>
                </div>
                <script>
                    function show() {
                        document.getElementById('links').style.display = 'block'
                    }
                </script>
                <div style="display: none;" id="links">
                    <a class="btn btn-link" href="/view/organization_dashboard.php">Org Admin </a>
                    <a class="btn btn-link" href="/view/organization_dashboard.php">Org User </a>
                    <a class="btn btn-link" href="">Doctor</a>
                </div>
            </div>
        </div>
        <script>
            const signInCard = document.querySelector("#sign-in")
            const signUpCard = document.querySelector("#sign-up")
            const sep = document.querySelector("#sep")

            function SignUp() {
                signInCard.classList.add("hidden")
                signUpCard.classList.remove("hidden");
                window.history.replaceState(null, null, "?active=signup");

            }

            function SignIn() {
                signUpCard.classList.add("hidden")
                signInCard.classList.remove("hidden");
                window.history.replaceState(null, null, "?active=signin");
            }
        </script>
    </div>
</div>