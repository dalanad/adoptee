<?php require_once __DIR__ . "./../_layout/layout.php" ?>
<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">

<style>
    .separator {
        margin: 1rem 0;
        grid-column: 1 / -1;
        display: flex;
        align-items: center;
        color: var(--gray-5);
        font-weight: 300;
        line-height: 1rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        grid-column-gap: .5rem;
    }

    .separator::after {
        height: 1px;
        content: " ";
        display: block;
        background: var(--gray-2);
        margin-left: .5rem;
        flex: 1 1 0;
    }
</style>

<div class="centered-container">
    <div class="card-container" style="max-width: 500px; width: 100%;">
        <form style="margin: 1rem; flex: 1 1 0; max-width: 500px;" action="/doctor/process_registration" method="POST">
            <div style="display: flex; align-items:flex-end; ">
                <img src="/assets/images/consultations/doctor_standing.png" style="width: 50px;" />
                <div>
                    <div> Welcome to Adoptee </div>
                    <div style="font-size:1.5rem">Register As A Doctor </div>
                </div>

            </div>
            <div class="form-grid">
                <div class="separator body-text"><i class="far fa-user"></i> &nbsp; User Information</div>
                <div class="field">
                    <label>Full Name </label>
                    <input class="ctrl" type="text" name="name" required>
                </div>

                <div class="field">
                    <label>Email</label>
                    <input class="ctrl" type="email" name="email" required>
                </div>
                <div class="field">
                    <label>Password</label>
                    <input class="ctrl" type="password" name="password" required>
                </div>
                <div class="field">
                    <label>Confirm Password</label>
                    <input class="ctrl" type="password" name="confirm-password" required>
                </div>

                <div class="separator body-text"> <i class="far fa-stethoscope"></i> &nbsp; Doctor Details</div>
                <div class="field">
                    <label>VCSL Registration Number</label>
                    <input class="ctrl" type="text" name="reg_no" required>
                </div>

                <div class="field">
                    <label>Contact Number</label>
                    <input class="ctrl" type="number" minlength="10" name="telephone" required>
                </div>

                <div class="field" style="grid-column: 1 / -1;">
                    <label>Address</label>
                    <input class="ctrl" type="text" name="address">
                </div>

                <div class="field" style="grid-column: 1 / -1;">
                    <label>Credentials / Qualifications</label>
                    <textarea class="ctrl" type="text" rows="5" name="credentials"></textarea>
                </div>
            </div>
            <div style="margin-top: 1rem;">
                <button type="submit" class="btn">Register</button>
            </div>
        </form>
    </div>
</div>