<?php require_once __DIR__ . "./../_layout/layout.php" ?>
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
                        <div class="verify-card">
                            <div class="verify-card-heading"> Email <i class="txt-clr green fa  fa-check-circle"></i></div>
                        </div>
                        <div class="verify-card">
                            <div class="verify-card-heading">Telephone
                                <i class="txt-clr orange fas fa-exclamation-circle"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600;text-align:center;margin:.5rem 0">OTP</div>
                                <input type="text" inputmode="numeric" required pattern="\d{6}" autocomplete="one-time-code" class="ctrl">

                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt2">
                        <!-- <a class="btn outline pink" href="?step=2">Back</a> -->
                        <a class="btn" href="/">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>