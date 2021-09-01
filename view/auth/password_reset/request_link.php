<?php require_once __DIR__ . "./../../_layout/layout.php" ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">

<div class="centered-container">
    <div class="card-container">
        <div class="animated-card" id="sign-up">
            <form action="/Auth/process_request_link" method="POST">

                <div class="m2" id="image" style="text-align:center;">
                    <img style="border-radius:8px; height:50px;" src="/assets/images/logo.png" />
                </div>

                <div class="title-text center">
                    <label style="font-size:1.1rem;">Reset Password</label>
                </div>

                <div class="body-text">
                    <p style="text-align:center">Please enter your email below to reset</br> the password</p>
                </div>
                <!-- <p class = "center wrap"> </p>-->

                <div>
                    <div class="field">
                        <label>Email</label>
                        <input class="ctrl" type="email" name="email">
                        <span class="field-msg"></span>
                    </div>

                </div>

                <div class="field center mt1">
                    <button class="btn orange" type="submit">Reset Pasword</btn>
                </div>

                <?php if (isset($_GET["sent"])) { ?>
                    <div style="color: green; font-weight:bold;font-weight: bold;text-align: center;margin-top: 1rem; ">
                        Password reset email has been sent
                    </div>
                <?php } ?>

                <div class="center mt2" style="font-size:0.8rem;">
                    <a class="btn-link bold text-decoration-none" href="/auth/sign_in">Back to Login</a>
                </div>
        </div>
    </div>
</div>
</div>