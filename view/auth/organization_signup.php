<?php require_once  __DIR__ . './../_layout/layout.php' ?>

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

    .centered-container {
        display: flex;
        height: 100%;
        flex-direction: column;
        justify-content: center;
    }

    @media (max-width:600px) {
        .centered-container {
            display: block;
        }
    }

    .stepper {
        display: flex;
    }

    .step {
        padding: 1rem 0;
        display: flex;
        align-items: center;
        /* cursor: pointer; */
        line-height: 1;
        border-radius: .4rem;
        color: var(--gray-5);
    }

    /* .step:hover {
        color: black;
        transition: all .2s ease-in-out;
    } */

    .step.active {
        color: var(--primary);
    }

    .step.active .step-icon {
        font-weight: 900;
    }

    .step:not(:first-child)::before,
    .step:not(:last-child)::after {
        min-width: 1rem;
        content: " ";
        height: .1rem;
        background-color: var(--gray-3);
        display: block;
    }

    .step-icon,
    .step-title {
        margin: 0 .3rem;
    }
</style>

<div class="centered-container">
    <div>
        <div style="margin: 0 auto;margin-bottom: 5rem;max-width: 700px;">
            <div class="p2">
                <div>Welcome to Adoptee</div>
                <h2 class="m0">Organization Registration</h2>
            </div>

            <div class="stepper px2">
                <div class="step active">
                    <i class="step-icon far fa-file-alt"></i>
                    <span class="step-title">Basic Details</span>
                </div>
                <div class="step">
                    <i class="step-icon far fa-user-circle "></i>
                    <span class="step-title">Admin User</span>
                </div>
                <div class="step">
                    <i class="step-icon fa fa-fingerprint"></i>
                    <span class="step-title">Verification</span>
                </div>
            </div>

            <div style="display: flex;">
                <div class="animated-card" id="sign-up">
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
                    <button class="btn" style="margin-top: 1em;">Next</button>
                </div>
                <div style="flex: 1 1 0;text-align: center;">
                    <img src="/assets/images/graphics/task-list.webp" style="height: 200px;">
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>