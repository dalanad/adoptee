<?php require_once __DIR__ . "./../_layout/layout.php" ?>
<?php $step = isset($_GET["step"]) ? $_GET["step"] : 1; ?>

<link rel="stylesheet" href="/assets/css/auth.css" type="text/css">
<style>
    .lg-3col-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        column-gap: 1rem;
    }

    @media (max-width:600px) {
        .lg-3col-grid {
            grid-template-columns: 1fr;
        }
    }

    .row {
        display: flex;
    }
</style>
<div class="centered-container">
    <div style="margin: 0 auto;max-width: 700px;padding: 1rem;">
        <div style="display: flex; align-items: flex-end; justify-content: space-between;">
            <div>
                <div>Welcome to Adoptee</div>
                <div style="font-size: 1.5rem;">Organization Registration</div>
            </div>
            <img src="/assets/images/graphics/task-list.webp" style="height: 100px;">
        </div>
        <form class="lg-3col-grid" method="POST" action="/auth/process_register_organization" id="step-1">
            <div class="separator body-text"><i class="far fa-file-alt"></i> &nbsp; Basic Information</div>
            <div class="field" style="grid-column: span 2;">
                <label>Organization Name</label>
                <input class="ctrl" type="text" name="name" required/>
            </div>
            <div class="field">
                <label>Mobile Phone Number</label>
                <input class="ctrl" type="telephone" name="telephone" required />
            </div>
            <div class="field">
                <label>Address Line 1</label>
                <input class="ctrl" type="text" name="address_line_1" required/>
            </div>
            <div class="field">
                <label>Address Line 2</label>
                <input class="ctrl" type="text" name="address_line_2" required />
            </div>
            <div class="field">
                <label>City</label>
                <input class="ctrl" type="text" name="city" required />
            </div>
            <div class="separator body-text"><i class="far fa-user"></i> &nbsp;User</div>
            <div class="field">
                <label>Email Address</label>
                <input class="ctrl" type="email" name="email" required />
            </div>
            <div class="field">
                <label>Password</label>
                <input class="ctrl" type="password" name="password" required/>
            </div>
            <div class="field">
                <label>Confirm Password</label>
                <input class="ctrl" type="password" name="confirm-password" onkeyup="validateForm(event)"  required />
            </div>
           
            <div style="grid-column: 1 / -1; margin-top:1rem;display:flex;justify-content:space-between">
                <a class="btn btn-faded pink" href="/view/auth/sign_in.php?active=signup">Go Back</a>
                <button class="btn" type="submit">Register</button>
            </div>
        </form>
    </div>
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