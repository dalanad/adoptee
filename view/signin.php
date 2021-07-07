<?php require_once  dirname(__FILE__) . './_layout/layout.php' ?>

<style>
    .bg-primary {
        background-color: var(--primary);
    }

    .animated-card {
        overflow: hidden;
        width: 280px;
        transition: width 0.3s ease-out, padding 0.5s ease-out;
        white-space: nowrap;
        border-radius: 16px;
        padding: 1em;
    }

    .animated-card.hidden {
        width: 0;
        padding-left: 0px;
        padding-right: 0;
    }
</style>
<div style="margin: .5em;display: flex; height: 100%; flex-direction: column; justify-content: center;">
    <div>
        <div style="display: flex;margin: 0 auto;max-width: 700px;">
            <div class="animated-card hidden" id="sign-up">
                <div>Welcome to Adoptee</div>
                <div style="font-size: 1.5em;font-weight:700;margin-bottom: 1.2em;">Sign Up</div>
                <div class="field">
                    <label>Name</label>
                    <input class="ctrl" type="email" />
                    <span class="field-msg"> </span>
                </div>
                <div class="field">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" />
                    <span class="field-msg"> </span>
                </div>
                <button class="btn" style="margin-top: 1em;">Sign Up</button>
                <div style="text-align: end;">
                    <button class="btn btn-link" style="margin-top: 1em;font-size:small " onclick="SignIn()">Sign In Instead</button>
                </div>
            </div>
            <div class="animated-card bg-primary" id="sep" style="transition:background-color .3s ease-out;z-index: 0;flex:1 1 0"></div>
            <div class="animated-card" id="sign-in">
                <div>Welcome to Adoptee</div>
                <div style="font-size: 1.5em;font-weight:700;margin-bottom: 1.2em;">Sign In</div>
                <div class="field">
                    <label>Email Address</label>
                    <input class="ctrl" type="email" />
                    <span class="field-msg"> </span>
                </div>
                <div class="field">
                    <label>Password</label>
                    <input class="ctrl" type="password" />
                    <a href="#" class="field-msg"> Forgot Password ? </a>
                </div>
                <a class="btn" style="margin-top: 1em;" href="/view/home.php">Sign In</a>
                <div style="text-align: end;">
                    <button class="btn btn-link" style="margin-top: 1em;font-size:small" onclick="SignUp()">Sign Up Instead</button>
                </div>
            </div>
        </div>
        <script>
            const signInCard = document.querySelector("#sign-in")
            const signUpCard = document.querySelector("#sign-up")
            const sep = document.querySelector("#sep")

            function SignUp() {
                signInCard.classList.add("hidden")
                signUpCard.classList.remove("hidden")
            }

            function SignIn() {
                signUpCard.classList.add("hidden")
                signInCard.classList.remove("hidden")
            }
        </script>
    </div>
</div>