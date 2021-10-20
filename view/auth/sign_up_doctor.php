<?php require_once __DIR__ . "/../_layout/layout.php" ?>
<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">
<div class="card-container" style="max-width: 500px;">
    <form style="margin: 1rem;flex:1 1 0" action="/auth/process_doctor_registration" method="POST" enctype="multipart/form-data">
        <div style="display: flex; align-items:flex-end;">
            <img src="/assets/images/consultations/doctor_standing.png" style="width: 50px;" />
            <div>
                <div> Welcome to Adoptee </div>
                <div style="font-size:1.5rem">Register As A Doctor </div>
            </div>
        </div>

        <?php if (isset($_SESSION['form_errors'])) { ?>
            <div class="alert red">
                <ul>
                    <?php foreach ($_SESSION['form_errors'] as  $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php  }  ?>

        <div class="form-grid">
            <div class="separator body-text"><i class="far fa-user"></i> &nbsp; User Information</div>
            <div class="field">
                <label>Full Name </label>
                <input class="ctrl" type="text" autocomplete="name" name="name" required>
            </div>
            <div class="field">
                <label>Email</label>
                <input class="ctrl" autocomplete="email" type="email" name="email" required>
            </div>
            <div class="field">
                <label>Password</label>
                <input class="ctrl" type="password" autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$" name="password" required>
            </div>
            <div class="field">
                <label>Confirm Password</label>
                <input class="ctrl" type="password" autocomplete="new-password" name="confirm-password" onkeyup="validateForm(event)" required>
            </div>
            <small class="field-hint" style="grid-column: 1/ span 2;">* Include upper & lower case letters, numbers and special characters </small>
        </div>
        <div class="form-grid">
            <div class="separator body-text"> <i class="far fa-stethoscope"></i> &nbsp; Doctor Details</div>
            <div class="field">
                <label>VCSL Registration Number</label>
                <input class="ctrl" type="number" name="reg_no" required>
            </div>
            <div class="field">
                <label>Proof of Registration</label>
                <input type="file" name="proof_image[]" class="ctrl" multiple accept="image/*" required>
                <span class="field-msg">Upload a photo of your registration</span>
            </div>
            <div class="field">
                <label>Contact Number (Mobile)</label>
                <input class="ctrl" pattern="07[0-9]{8}" name="telephone" required>
                <small class="field-hint">Format : 07XXXXXXXX</small>
            </div>
            <div class="field">
                <label>Contact Number (Fixed)</label>
                <input class="ctrl" type="number" minlength="10" name="telephone_fixed" required>
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
        <div style="margin: 1rem 0;display:flex;justify-content:space-between">
            <a class="btn btn-faded pink" href="/view/auth/sign_in.php?active=signup">Go Back</a>
            <button type="submit" class="btn">Register</button>
        </div>
    </form>
</div>
<script>
    let password = document.querySelector("[name='password']")
    let confirm_password = document.querySelector("[name='confirm-password']")

    const form = document.querySelector('form');

    form.addEventListener("submit", validateForm)

    function validateForm(event) {

        form.querySelectorAll(".field-msg").forEach(e => {
            e.remove()
        })

        form.querySelectorAll(".field").forEach(e => {
            e.classList.remove("invalid")
        })

        let valid = password.value === confirm_password.value;


        if (!valid) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            let error_msg = document.createElement("span")
            error_msg.classList.add('field-msg')
            error_msg.innerText = 'Password Not Matching'
            error_msg.style.color = 'var(--red)'
            confirm_password.parentElement.append(error_msg)
            confirm_password.parentElement.classList.add("invalid")
        }

    }
</script>