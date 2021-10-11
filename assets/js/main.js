// registers the service worker required for the PWA
if ('serviceWorker' in navigator) {
	window.addEventListener('load', () => navigator.serviceWorker.register('/assets/js/service-worker.js', { scope: '/' }));
}

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

function init() {
	formValidations();
	document.querySelectorAll("input[photos-input]").forEach(photoInput);
}

let email_regex = /[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]/;

function formValidations() {
	// form validations
	document.querySelectorAll("form").forEach((form) => {
		form.setAttribute("novalidate", "");
		form.addEventListener("submit", function (e) {
			let valid = true;

			// validate field
			form.querySelectorAll("input, select").forEach((field) => {
				let is_field_valid = validateField(field);
				if (!is_field_valid) {
					valid = false;
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
		input.closest(".field").querySelector("label").insertAdjacentHTML("beforeend", `<span style="color:red"> *</span>`);
	});

	document.querySelectorAll("input, select").forEach(ValidationMessages);
}

// function to show an error msg on a given field
function addErrorMsg(input, msg) {
	let span = input.closest(".field").querySelector(".field-msg");
	if (!span) {
		span = document.createElement("span");
		input.closest(".field").appendChild(span);
	}
	span.innerHTML = "<i class='fa-exclamation-circle far'></i> &nbsp" + msg;
	span.style.color = "red";
	span.classList.add("field-msg", "fade");
	input.style.borderColor = "red";
}

function clearErrorMsg(input) {
	let msg = input.closest(".field").querySelector(".field-msg");
	if (msg) {
		msg.remove();
	}
	input.style.borderColor = null;
}

function validateField(input) {
	clearErrorMsg(input);
	// validation using built in validations
	if (input.validationMessage) {
		addErrorMsg(input, input.validationMessage);
		return false;
	}

	// extra validation for emails
	if (input.type == "email" && !email_regex.test(input.value)) {
		addErrorMsg(input, "Please enter a valid email");
		return false;
	}

	return true;
}

function ValidationMessages(input) {
	let timer;
	input.addEventListener("keyup", (event) => {
		clearTimeout(timer);
		if (event.keyCode != 9) {
			timer = setTimeout(() => validateField(input), 800);
		}
	});

	input.addEventListener("focusout", (event) => validateField(input));
}

function uploadFile() {
	let input = document.createElement("input");
	input.setAttribute("type", "file");
	// input.setAttribute("multiple", true);
	input.setAttribute("accept", "image/*");
	input.click();

	let res = new Promise((resolve, reject) => {
		input.addEventListener("change", () => {
			let formData = new FormData();
			for (const file of input.files) {
				formData.append(file.name, file);
			}

			fetch("/main/upload", { method: "POST", body: formData })
				.then((r) => r.json())
				.then((e) => {
					console.log(e[0]);
					input.remove();
					resolve(e[0]);
				})
				.catch(reject);
		});
	});

	return res;
}

function photoInput(input) {
	let container = document.createElement("div");
	container.classList.add("photo-picker");
	container.innerHTML = "<button class='btn outline green' type='button'><i class='fa fa-plus'></i></button>";

	input.insertAdjacentElement("beforeBegin", container);
	input.type = "hidden";

	//
	let add_btn = container.querySelector("button");
	add_btn.onclick = uploadPhoto;

	//
	JSON.parse(input.value || "[]").forEach(addPhoto);

	//
	async function uploadPhoto() {
		add_btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
		let url = await uploadFile();
		add_btn.innerHTML = "<i class='fa fa-plus'></i>";
		if (url) {
			let current_array = JSON.parse(input.value)
			current_array.push(url)
			input.value = JSON.stringify(current_array)
			addPhoto(url);
		}
	}

	//
	async function addPhoto(url) {
		let photo = document.createElement("div");
		photo.style.backgroundImage = `url(${url})`;
		add_btn.insertAdjacentElement("beforebegin", photo);
		photo.onclick = () => removePhoto(photo, url);
	}

	// remove photo update input
	function removePhoto(photo, url) {
		if (confirm("Are you sure that, you want to delete this photo?")) {
			photo.remove();
			let urls = JSON.parse(input.value || "[]") || [];
			urls.splice(urls.indexOf(url), 1);
			input.value = JSON.stringify(urls);
		}
	}
}
