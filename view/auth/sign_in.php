<?php require_once __DIR__ . "/../_layout/layout.php" ?>
<?php $active = isset($_GET["active"]) ? $_GET["active"] : "sign_in"; ?>


<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">
<a class="btn btn-faded black" href="/" style="margin: .5rem 1rem; "><i class="fa fa-chevron-left"></i>&nbsp; Home</a>
<div class="centered-container">
    <div style="padding: .5em;">
        <div class="card-container">
            <div class="spacer-card">
                <img src="/assets/images/auth/IMG_<?= rand(1, 4) ?>.svg" style='width:100%' />
            </div>
            <form class="animated-card <?= $active == 'sign_in' ? "hidden faded" : '' ?>" action="/auth/sign_up" method="POST" id="sign-up">
                <img src="/assets/images/logo_vector.svg" style='max-width:150px; margin-bottom:1rem' />
                <div>Welcome to Adoptee</div>
                <div class="title-text">Sign Up</div>
                <div class="field">
                    <label>Name</label>
                    <input class="ctrl" type="text" name="name" />
                    <span class="field-msg"></span>
                </div>
                <div class="field">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" name="email" />
                    <span class="field-msg"> </span>
                </div>

                <input type="submit" class="btn" value="Register" />

                <div class="body-text" style="margin-top: 1rem;">
                    Alreaday have an account ? <a class="btn btn-link" style="font-size:1em;padding:0" onclick="SignIn()">Sign In </a>
                </div>
                <div style="margin-top: 1rem;">
                    <div class="body-text">Register as</div>
                    <a class="btn outline green" href="/auth/organizationRegistration"> <i class="fa fa-hand-holding-heart"></i>&nbsp;Organization</a>
                    <a class="btn outline pink" href="/doctor/register"> <i class="fa fa-user-md"></i>&nbsp;Doctor</a>
                </div>
            </form>

            <form class="animated-card <?= $active == 'signup' ? "hidden faded" : '' ?>" method="post" action="/auth/process_sign_in" id="sign-in">
                <img src="/assets/images/logo_vector.svg" style='max-width:150px; margin-bottom:1rem' />
                <div>Welcome to Adoptee</div>
                <div class="title-text">Sign In</div>
                <div class="field">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" name="email" required />
                </div>
                <div class="field">
                    <label>Password</label>
                    <input class="ctrl" type="password" name="password" required />
                    <a href="/auth/request_link" class="field-msg"> Forgot Password ? </a>
                </div>
                <?php if (isset($_GET["error"])) { ?>
                    <div style="color: red; font-weight:bold;font-weight: bold;text-align: center;margin-top: 1rem; ">
                        Invalid Credentials
                    </div>
                <?php } ?>
                <button class="btn" style="margin: 1em 0;">Sign In</button>
                <div class="body-text">
                    Don't have an account ? <a class="btn btn-link" style="font-size:1em;padding:0" onclick="SignUp()">Sign Up </a>
                </div>
            </form>
        </div>
        <script>
            const signInCard = document.querySelector("#sign-in")
            const signUpCard = document.querySelector("#sign-up")
            const sep = document.querySelector("#sep")

            function SignUp() {
                signInCard.classList.add("faded")

                setTimeout(() => {
                    signUpCard.classList.remove("hidden");
                    signInCard.classList.add("hidden");

                    signUpCard.classList.remove("faded");
                }, 300)

                window.history.replaceState(null, null, "?active=signup");

            }

            function SignIn() {
                signUpCard.classList.add("faded")
                setTimeout(() => {
                    signInCard.classList.remove("hidden");
                    signUpCard.classList.add("hidden");

                    signInCard.classList.remove("faded");
                }, 300)
                window.history.replaceState(null, null, "?active=sign_in");
            }
        </script>
    </div>
</div>