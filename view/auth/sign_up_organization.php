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
        height: 200px;
    }



    .animated-card {
        width: 100%;
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
        <div style="margin: 0 auto;margin-bottom: 5rem;max-width: 700px;">
            <div class="heading">
                <div>
                    <div>Welcome to Adoptee</div>
                    <h2 class="m0">Organization Registration</h2>
                </div>
                <img src="/assets/images/graphics/task-list.webp">
            </div>
            <div class="stepper px2">
                <div class="step <?= $step == 1 ? 'active' : '' ?>">
                    <i class="step-icon far fa-file-alt"></i>
                    <span class="step-title">Basic Information</span>
                </div>
                <div class="step  <?= $step == 2 ? 'active' : '' ?>">
                    <i class="step-icon far fa-user-circle "></i>
                    <span class="step-title">User</span>
                </div>
                <div class="step  <?= $step == 3 ? 'active' : '' ?>">
                    <i class="step-icon fa fa-fingerprint"></i>
                    <span class="step-title">Verification</span>
                </div>
            </div>
            <div style="display: flex;">

                <form class="animated-card <?= $step != 1 ? 'hidden' : '' ?>" method="POST" action="?step=2" id="step-1">
                    <div class="lg-3col-grid">
                        <div class="field" style="grid-column: span 2;">
                            <label>Organization Name</label>
                            <input class="ctrl" type="text" name="name" />
                            <span class="field-msg"> </span>
                        </div>
                        <div class="field">
                            <label>Telephone</label>
                            <input class="ctrl" type="telephone" name="telephone" />
                            <span class="field-msg"> </span>
                        </div>
                        <div class="field">
                            <label>Address Line 1</label>
                            <input class="ctrl" type="text" name="address_line_1" />
                            <span class="field-msg"> </span>
                        </div>
                        <div class="field">
                            <label>Address Line 2</label>
                            <input class="ctrl" type="text" name="address_line_2" />
                            <span class="field-msg"> </span>
                        </div>
                        <div class="field">
                            <label>City</label>
                            <input class="ctrl" type="text" name="city" />
                            <span class="field-msg"> </span>
                        </div>
                    </div>
                    <div class="flex justify-between mt2">
                        <div></div>
                        <button class="btn" type="submit" style="margin-top: 1em;">Next</button>
                    </div>
                </form>

                <form class="animated-card <?= $step != 2 ? 'hidden' : '' ?>" action="?step=3" id="step-2" method="post">
                    <div class="flex">
                        <div class="flex-auto mx1">
                            <div class="field">
                                <label>Email Address</label>
                                <input class="ctrl" type="email" name="email" />
                                <span class="field-msg"> </span>
                            </div>
                        </div>
                        <div class="flex-auto mx1">
                            <div class="field">
                                <label>Password</label>
                                <input class="ctrl" type="password" name="password" />
                                <span class="field-msg"> </span>
                            </div>
                            <div class="field">
                                <label>Confirm Password</label>
                                <input class="ctrl" type="password" name="confirm-password" />
                                <span class="field-msg"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt2">
                        <!-- <a class="btn outline pink" href="?step=1">Back</a> -->
                        <button class="btn" type="submit">Next</button>
                    </div>
                </form>

                <div class="animated-card <?= $step != 3 ? 'hidden' : '' ?>" id="step-3">
                    <style>
                        .verify-card {
                            border: .1rem solid var(--gray-3);
                            width: 300px;
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
                    <div style="display: flex;flex-direction:column;align-items:center">
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
                        <a class="btn outline pink" href="?step=2">Back</a>
                        <a class="btn" href="/view/org/dashboard.php">Finish</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>