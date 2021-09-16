<?php require_once __DIR__ . "/../_layout/layout.php" ?>
<?php $step = isset($_GET["step"]) ? $_GET["step"] : 1; ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">
<style>
    .heading {
        padding: 1rem;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }

    .heading img {
        height: 100px;
    }

    .animated-card {
        width: 100%;
        transition: none;
    }

    .lg-3col-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        column-gap: 1rem;
    }

    @media (max-width:600px) {
        .heading img {
            height: 80px;
        }

        .lg-3col-grid {
            grid-template-columns: 1fr;
        }

    }
</style>
<div class="centered-container">
    <div>
        <div style="margin: 0 auto;margin-bottom: 5rem;max-width: 400px;">
            <div class="heading">
                <div>
                    <div>Welcome to Adoptee</div>
                    <h2 class="m0">User Verification</h2>
                </div>
                <img src="/assets/images/auth/security.webp">
            </div>

            <div style="display: flex;">
                <div class="animated-card " id="step-3">
                    <style>
                        .verify-card {
                            border: .1rem solid var(--gray-3);
                            width: 100%;
                            padding: .5rem .8rem;
                            margin: .2rem 0;
                            border-radius: .4rem;

                            line-height: 1;
                        }

                        .verify-card-heading {
                            display: flex;
                            justify-content: space-between;
                        }
                    </style>
                    <div style="display: flex;flex-direction:column;align-items:center;margin:1rem">

                        <?php if ($status == 'email_sent') { ?>

                            <div class="verify-card">
                                <div class="verify-card-heading"> Email <i class="txt-clr orange fa  fa-check-circle"></i></div>
                                <div style="white-space: pre-wrap; margin: 1rem 0; text-align: center;">
                                    You have been successfully registered.<br><br>
                                    Now you need to confirm your email. A letter was sent to your email (<code> <?= $user["email"] ?></code>), follow the instructions to complete the registration.
                                </div>
                            </div>

                        <? } ?>
                        <?php if ($status == 'email_verified') { ?>

                            <div class="verify-card">
                                <div class="verify-card-heading"> Email <i class="txt-clr green fa  fa-check-circle"></i></div>
                            </div>
                            <form action="?email=<?= $user["email"] ?>&action=send_sms" method="POST" class="verify-card">
                                <div class="verify-card-heading">Telephone
                                    <i class="txt-clr orange fas fa-exclamation-circle"></i>
                                </div>
                                <div style="margin-top:1rem;text-align:center">
                                    We will send a code to your telephone
                                    <br> <br><b> 07****<?= substr($user["telephone"], 6) ?></b>
                                </div>
                                <div style="margin-top: 1rem; text-align:center">
                                    <button type="submit" class="btn btn-faded green">SEND OTP</button>
                                </div>
                            </form>

                        <? } ?>
                        <?php if ($status == 'sms_sent' || $status == 'otp_invalid') { ?>

                            <form action="?email=<?= $user["email"] ?>&action=validate_sms" method="POST" class="verify-card">
                                <div class="verify-card-heading">Telephone
                                    <i class="txt-clr orange fas fa-exclamation-circle"></i>
                                </div>
                                <div class="field">
                                    <div style="font-weight: 600;text-align:center;margin:.5rem 0">OTP</div>
                                    <input type="text" name="otp" inputmode="numeric" required pattern="\d{6}" autocomplete="one-time-code" class="ctrl">
                                    <?php if ($status == 'otp_invalid') { ?><div class="field-msg" style="color: red;">Invalid OTP</div><? } ?>
                                </div>
                                <div style="margin-top: 1rem; text-align:center">
                                    <button type="submit" class="btn outline green">Verify</button>
                                </div>
                                <?= $_SESSION["otp"] ?>
                            </form>

                        <? } ?>
                        <?php if ($status == 'sms_verified') { ?>

                            <div style="white-space: pre-wrap; margin: 1rem 0; text-align: center;">Verification Complete</div>
                            <div class="flex justify-between mt2">
                                <a href="/auth/sign_in" class="btn outline">Continue to Login</a>
                            </div>

                        <? } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>