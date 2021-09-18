function sleep(ms) {
	return new Promise((resolve) => setTimeout(resolve, ms));
}

function params(data, navigate = true) {
	let url = new URL(window.location.href);
	for (const key in data) {
		if (Object.prototype.hasOwnProperty.call(data, key)) {
			const element = data[key];
			url.searchParams.set(key, element);
			if (element == null) {
				url.searchParams.delete(key);
			}
		}
	}
	if (navigate) {
		window.location = decodeURIComponent(url.href);
	} else {
		window.history.replaceState(null, null, url.search);
	}
}

window.params = params;

document.addEventListener("DOMContentLoaded", () => init(), false);
let email_regex = /[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]/;

function init() {
	
	// form validations
	document.querySelectorAll("form").forEach((form) => {
		form.addEventListener("submit", function (e) {
			let valid = true;
			
			// validate emails
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

	// add required marker
	document.querySelectorAll(".field .ctrl[required]").forEach((input) => {
		input.parentElement.querySelector("label").insertAdjacentHTML("beforeend", `<span style="color:red"> *</span>`);
	});
}
