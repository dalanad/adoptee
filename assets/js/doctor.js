window.addEventListener("DOMContentLoaded", (event) => {
	InitSortHeaders();
});

class Calender {
	_el;
	_date;
	_onDateChanged = Function("");

	constructor(hostElement) {
		this._el = hostElement;
		let url = new URL(window.location.href);
		this.setDate(url.searchParams.get("calender_date") || new Date());
	}

	setDate(dt) {
		console.log(dt);
		this._date = new Date(dt);
		params({ calender_date: this._date.toISOString().substr(0, 10) }, false);
		this.show();
	}

	previousMonth() {
		this._date.setMonth(this._date.getMonth() - 1);
		this.show();
	}

	nextMonth() {
		this._date.setMonth(this._date.getMonth() + 1);
		this.show();
	}

	onChange(fn) {
		this._onDateChanged = fn;
	}

	get first_date_of_calender() {
		let d = new Date(this._date);
		d.setDate(0);
		d.setDate(d.getDate() - ((d.getDay() + 6) % 7));
		return d;
	}

	show() {
		this._onDateChanged();

		this._el.innerHTML = ` 
        <div style="display: flex;align-items:center">
            <div class="cal-month">February</div>
            <div>
                <button class="month btn btn-link"><i class="fa fa-angle-left"></i></button>
                <button class="month btn btn-link"><i class="fa fa-angle-right"></i></button>
            </div>
        </div>
        <div class="cal-body"> </div>`;

		let monthName = this._el.querySelector(".cal-month");
		let previousMonth = this._el.querySelector("button.month:first-child");
		let nextMonth = this._el.querySelector("button.month:last-child");

		previousMonth.addEventListener("click", (_) => this.previousMonth());
		nextMonth.addEventListener("click", (_) => this.nextMonth());

		monthName.innerText = this._date.toLocaleString("default", {
			month: "long",
			year: "numeric",
		});

		let dates = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

		dates.forEach((el) => {
			let box = this.createDateEl(el);
			box.classList.add("head");
		});

		let current_date = this.first_date_of_calender;

		for (let i = 0; i < 42; i++) {
			if (current_date.getDay() == 1 && current_date.getMonth() > this._date.getMonth() && current_date.getFullYear() >= this._date.getFullYear()) break;

			let date = this.createDateEl(current_date.getDate());
			let dx = new Date(current_date);

			date.addEventListener("click", () => this.setDate(dx));

			// fade other month dates
			if (current_date.getMonth() !== this._date.getMonth()) {
				date.classList.add("inactive");
			}

			// set active date
			else if (current_date.getDate() === this._date.getDate()) {
				date.classList.add("active");
			}

			current_date.setDate(current_date.getDate() + 1);
		}
	}

	createDateEl(text) {
		let calBody = this._el.querySelector(".cal-body");
		let date = document.createElement("div");
		date.classList.add("date");
		date.innerText = text;
		calBody.append(date);
		return date;
	}
}

class AppointmentsTimeline {
	_el;
	_date = new Date();
	_cells = {};
	_data = {};
	_onDataChanged = () => {};
	_onCellSelected = () => {};
	_activeCell = null;

	isSchedule = false;
	canEdit = false;

	get start_date() {
		let start_date = new Date(this._date);
		start_date.setDate(start_date.getDate() - ((start_date.getDay() + 6) % 7));
		return start_date;
	}

	constructor(hostElement, isSchedule = false) {
		this._el = hostElement;
		this.isSchedule = isSchedule;
		this.render().then((e) => {
			if (isSchedule) {
				this.showSchedule();
			} else {
				this.showBookings();
			}
		});
	}

	async showSchedule() {
		let data = await fetch("/doctor/get_schedule").then((res) => res.json());

		for (const day in data) {
			let slots = data[day];

			let current_date = new Date(this.start_date);
			current_date.setDate(current_date.getDate() + Number(day));

			for (const slot in slots) {
				this.markCellAvailable(current_date.toISOString().substr(0, 10), slot);
				await sleep(30);
			}
		}
	}

	async saveSchedule() {
		fetch("/doctor/update_schedule", {
			method: "post",
			body: JSON.stringify({ schedule: this._data }),
			headers: {
				"Content-Type": "application/json",
			},
		})
			.then((res) => res.json())
			.then(console.log);
	}

	async showBookings() {
		let end_date = new Date(this.start_date);
		end_date.setDate(end_date.getDate() + Number(7));

		let start = this.start_date.toISOString().substr(0, 10);
		let end = end_date.toISOString().substr(0, 10);

		let data = await fetch(`/doctor/get_live_bookings?start_date=${start}&end_date=${end}`).then((res) => res.json());

		for (const date in data) {
			let bookings = data[date];

			for (const time in bookings) {
				let cell = this.markBookingCell(date, time, data[date][time]);
				cell.addEventListener("click", (ev) => {
					this._activeCell ? this._activeCell.classList.remove("selected") : null;
					this._onCellSelected(date, time, data[date][time]);
					this._activeCell = cell;
					this._activeCell.classList.add("selected");
				});
			}
		}
	}

	markBookingCell(date_str, time_str, data) {
		let cell = this._cells[date_str][time_str];
		if (data) {
			let { status, animal_type } = data;
			let status_colors = {
				PENDING: "orange",
				ACCEPTED: "-",
				CANCELLED: "red",
			};
			cell.classList.add("has-data", "txt-clr", status_colors[status]);
			cell.innerHTML = `<i class="fa fa-${String(animal_type).toLowerCase()}"></i>&nbsp;${status}`;
		}
		return cell;
	}

	enableEditing() {
		this.canEdit = true;
		this._el.classList.add("editing");
	}

	disableEditing() {
		this.canEdit = false;
		this._el.classList.remove("editing");
	}

	onChange(fn) {
		this._onDataChanged = fn;
	}

	onCellSelected(fn) {
		this._onCellSelected = fn;
	}

	async render() {
		this._el.innerHTML = "";

		// time
		let time_col = this.createCell("", "timeline-column");
		this.createCell("<i class='far fa-clock'></i>", "cell heading", time_col);

		for (let i = 8; i < 22; i++) {
			this.createCell(`${i}.00`, "heading cell", time_col);
		}

		// date headers
		let current_date = new Date(this.start_date);

		let dates = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

		for (let i = 0; i < 7; i++) {
			let column = this.createCell("", "timeline-column");

			if (!this.isSchedule && current_date.getDate() == this._date.getDate()) {
				column.classList.add("active");
				column.scrollIntoView({ behavior: "smooth", inline: "center" });
			}

			let date_str = current_date.toISOString().substr(0, 10);

			this._cells[date_str] = {};
			this._data[date_str] = {};

			let date = `<b style="font-size:1.2em;">${current_date.getDate()}</b>` + `<span>${dates[i]}</span>`;

			let w_day = `<b style="font-size:1.2em;">${dates[i]}</b>`;

			this.createCell(this.isSchedule ? w_day : date, "cell heading fade", column);

			// await sleep(50);

			for (let i = 8; i < 22; i = i + 0.5) {
				let time_str = `${(Math.floor(i) + "").padStart(2, "0")}:${(i % 1) * 6}0:00`;

				let slot = this.createCell(``, "cell", column);

				this._cells[date_str][time_str] = slot;
				this._data[date_str][time_str] = null;

				slot.addEventListener("click", (ev) => {
					if (this.isSchedule && this.canEdit) {
						if (this._data[date_str][time_str] !== "AVAILABLE") {
							this.markCellAvailable(date_str, time_str);
						} else {
							this.clearCell(date_str, time_str);
						}
						this._onDataChanged();
					}
				});
			}

			current_date.setDate(current_date.getDate() + 1);
		}
	}

	markCellAvailable(date_str, time_str) {
		let slot = this._cells[date_str][time_str];
		this._data[date_str][time_str] = "AVAILABLE";
		slot.innerText = "AVAILABLE";
		slot.style.background = "var(--green)";
		slot.style.color = "white";
		slot.classList.add("fade");
	}

	clearCell(date_str, time_str) {
		let slot = this._cells[date_str][time_str];
		this._data[date_str][time_str] = null;
		slot.innerText = "";
		slot.style.background = "unset";
	}

	createCell(text, classList, parent) {
		let el = document.createElement("div");
		el.classList = classList;
		el.innerHTML = text;
		(parent ?? this._el).append(el);
		return el;
	}
}

function InitSortHeaders() {
	for (let e of document.querySelectorAll("th[data-field]")) {
		e.classList.add("sort-header");
		e.dataset.dir = new URLSearchParams(window.location.search).getAll(`sort[${e.dataset.field}]`);
		let i = document.createElement("i");
		e.appendChild(i);
		i.style.marginLeft = "1rem";
		i.style.fontSize = "1.3em";
		i.style.lineHeight = "0";
		i.classList = e.dataset.dir ? `far fa-sort-amount-${e.dataset.dir === "ASC" ? "down-alt" : "up"}` : "";
		e.addEventListener("click", () => {
			if (e.dataset.dir == "DESC") {
				delete e.dataset.dir;
			} else {
				e.dataset.dir = e.dataset.dir == "ASC" ? "DESC" : "ASC";
			}
			if (e.dataset.dir) {
				params({ [`sort[${e.dataset.field}]`]: e.dataset.dir });
			} else {
				params({ [`sort[${e.dataset.field}]`]: null });
			}
		});
	}
}

async function initChat(id) {
	let chat_window = document.querySelector(".chat-window");

	chat_window.innerHTML = `
	<div class="chat-header">
		<div class="animal-image"> </div>
		<div style="font-weight: 500;" id="animal-name">&nbsp;</div>
		<div style="flex:1 1 0"></div>
		<div>
			<button class="btn btn-link black"><i class="far fa-phone"></i></button>
			<button class="btn btn-faded green"><i class="fa fa-check"></i></button>
		</div>
	</div>
	<div class="chat-body">
		<div class="msg shine" style="width:6rem">&nbsp;</div>
		<div class="msg shine sent" style="width:10rem">&nbsp;</div>
		<div class="msg shine" style="width:5rem">&nbsp;</div>
		<div class="msg shine" style="width:8rem">&nbsp;</div>
		<div class="msg shine sent" style="width:10rem">&nbsp;</div>
		<div class="msg shine" style="width:3rem">&nbsp;</div>
	</div>
	<div class="chat-footer">
		<button class="btn btn-link black" id="btn-prescribe"><i class="far fa-file-prescription"></i></button>
		<button class="btn btn-link black" id="btn-upload"><i class="fa fa-paperclip"></i></button>
		<input name="message" class="ctrl" placeholder="Your Message ...">
		<button id="send-message" class="btn btn-link black"><i class="fa fa-paper-plane"></i></button>
	</div>`;

	let chat_body = document.querySelector(".chat-body");
	let chat_header = document.querySelector(".chat-header");

	const con = await fetch("/doctor/get_consultation_by_id?consultation_id=" + id).then((e) => e.json());

	chat_header.classList.remove("fade");
	chat_window.querySelector(".animal-image").style.backgroundImage = `url('/assets/data/${con.animal.type.toLowerCase()}s/${con.animal.animal_id}.jpg')`;
	chat_window.querySelector("#animal-name").innerHTML = `&nbsp; ${con.animal.name}`;
	chat_header.classList.add("fade");

	async function displayMessages() {
		let messages = await fetch(`/doctor/get_messages?consultation_id=${id}`).then((r) => r.json());

		chat_body.innerHTML = "";

		for (const msg of messages) {
			let msg_template = `<div class="msg ${msg.is_sender == "1" && "sent"}">${msg.message}</div>`;
			chat_body.insertAdjacentHTML("beforeend", msg_template);
		}
	}

	chat_window.querySelector("#btn-prescribe").addEventListener("click", addPrescription);
	chat_window.querySelector("#btn-upload").addEventListener("click", uploadFile);

	async function addPrescription() {
		let html = await fetch("/view/doctor/prescription.php").then((e) => e.text());
		showOverlay(`<div style='width:500px;height:600px;overflow:auto'>${html}</div>`);
	}

	async function postMessage(consultationId, message) {
		return fetch("/doctor/post_message", {
			method: "post",
			body: JSON.stringify({
				consultation_id: consultationId,
				message,
			}),
			headers: {
				"Content-Type": "application/json",
			},
		}).then((res) => res.json());
	}

	chat_window.querySelector("#send-message").addEventListener("click", async () => {
		let input_msg = chat_window.querySelector("[name='message']");
		input_msg.setAttribute("disabled", true);
		await postMessage(id, input_msg.value);
		await displayMessages();
		input_msg.removeAttribute("disabled");
		input_msg.value = "";
	});

	clearInterval(this.interval);
	this.interval = setInterval(displayMessages, 1000);
	setTimeout(displayMessages, 200);
}

function showOverlay(html) {
	let div = document.createElement("div");
	div.classList.add("overlay", "fade");
	div.insertAdjacentHTML("afterbegin", "<div>" + html + "</div>");
	document.body.appendChild(div);
	div.addEventListener("click", (e) => {
		div.classList.remove("fade");
		if (e.target == div) div.remove();
	});
}



