// wait for a given duration in milliseconds
function sleep(ms) {
	return new Promise((resolve) => setTimeout(resolve, ms));
}

// updates the url of the page with given query parameters
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
					addErrorMsg(emailField, "This is not a valid email");
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

	document.querySelectorAll("input, select").forEach(ValidationMessages);
}

// function to show an error msg on a given field
function addErrorMsg(input, msg) {
	let span = input.parentElement.querySelector(".field-msg");
	if (!span) {
		span = document.createElement("span");
		input.parentElement.appendChild(span);
	}
	span.innerHTML = msg;
	span.style.color = "red";
	span.classList.add("field-msg", "fade");
	input.style.borderColor = "red";
}

function clearErrorMsg(input) {
	let msg = input.parentElement.querySelector(".field-msg");
	if (msg) {
		msg.remove();
	}
	input.style.borderColor = null;
}

function showValidationErrors(input) {
	clearErrorMsg(input);
	if (input.validationMessage) {
		addErrorMsg(input, input.validationMessage);
	}
}

function ValidationMessages(input) {
	let timer;
	input.addEventListener("keyup", () => {
		clearTimeout(timer);
		timer = setTimeout(() => showValidationErrors(input), 800);
	});
}
