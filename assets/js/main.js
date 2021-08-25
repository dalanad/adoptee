document.addEventListener("DOMContentLoaded", () => init(), false);
let email_regex = /[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]/;

function init() {
	document.querySelectorAll("form").forEach((form) => {

		form.addEventListener("submit", function (e) {
			let valid = true;
			
            form.querySelectorAll("input[type=email]").forEach((emailField) => {
				if (!email_regex.test(emailField.value)) {
					valid = false;
                    
					let span = document.createElement("span");
					span.innerHTML = "Value is not a valid email";
					span.style.color = "red";
					span.classList.add("field-msg");

					emailField.style.borderColor = "red";
					emailField.parentElement.appendChild(span);
				}
			});

			if (!valid) {
				e.preventDefault();
				e.stopPropagation();
			}
		});
	});
}
