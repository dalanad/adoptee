class Calender {
	_hostElement;
	_date = new Date();
	_onDateChanged;

	constructor(hostElement) {
		this._hostElement = hostElement;
		this.render();
	}

	setDate(dt) {
		this._date = new Date(dt);
		this.render();
	}

	previousMonth() {
		this._date.setMonth(this._date.getMonth() - 1);
		this.render();
	}

	nextMonth() {
		this._date.setMonth(this._date.getMonth() + 1);
		this.render();
	}

	onChange(fn) {
		this._onDateChanged = fn;
	}

	render() {
		if (typeof this._onDateChanged === "function") {
			this._onDateChanged();
		}

		this._hostElement.innerHTML = ` 
        <div style="display: flex;align-items:center">
            <div class="cal-month">February</div>
            <div>
                <button class="month btn btn-link"><i class="fa fa-angle-left"></i></button>
                <button class="month btn btn-link"><i class="fa fa-angle-right"></i></button>
            </div>
        </div>
        <div class="cal-body"> </div>`;
		let previousMonth = this._hostElement.querySelector(
			"button.month:first-child"
		);
		previousMonth.addEventListener("click", (_) => this.previousMonth());

		let nextMonth = this._hostElement.querySelector("button.month:last-child");
		nextMonth.addEventListener("click", (_) => this.nextMonth());

		let monthName = this._hostElement.querySelector(".cal-month");

		monthName.innerText = this._date.toLocaleString("default", {
			month: "long",
		});

		let dates = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

		dates.forEach((el) => {
			let date = this.createDateEl(el);
			date.classList.add("head");
		});

		let current_date = new Date(this._date);
		current_date.setDate(-1);
		current_date.setDate(
			current_date.getDate() - ((current_date.getDay() + 6) % 7)
		);

		for (let i = 0; i < 42; i++) {
			if (
				current_date.getDay() == 1 &&
				current_date.getMonth() > this._date.getMonth()
			)
				break;

			let date = this.createDateEl(current_date.getDate());
			let dt = new Date(current_date);
			date.addEventListener("click", () => {
				this.setDate(dt);
			});
			if (current_date.getMonth() !== this._date.getMonth()) {
				date.classList.add("inactive");
			} else if (current_date.getDate() === this._date.getDate()) {
				// set active date
				date.classList.add("active");
			}

			current_date.setDate(current_date.getDate() + 1);
		}
	}

	createDateEl(text) {
		let calBody = this._hostElement.querySelector(".cal-body");
		let date = document.createElement("div");
		date.classList.add("date");
		date.innerText = text;
		calBody.append(date);
		return date;
	}
}

class AppointmentsTimeline {
	_hostElement;
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
		this._hostElement = hostElement;
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
		let data = appointments;

		for (const date in data) {
			let bookings = data[date];

			for (const time in bookings) {
				let cell = this.markBookingCell(date, time, data[date][time]);
				cell.addEventListener("click", (ev) => {
					this._activeCell
						? this._activeCell.classList.remove("selected")
						: null;
					this._onCellSelected(date, time, data[date][time]);
					this._activeCell = cell;
					this._activeCell.classList.add("selected");
				});
			}
		}
	}

	markBookingCell(date_str, time_str, data) {
		if (data) {
			this._cells[date_str][time_str].classList.add("has-data");
			this._cells[date_str][time_str].classList.add("txt-clr");
			let status_colors = { PENDING: "orange", ACCEPTED: "-", CANCELLED: "red" };
			this._cells[date_str][time_str].classList.add(status_colors[data.status]);

			this._cells[date_str][time_str].innerHTML = `
			<i class="fa fa-${String(data.animal_type).toLowerCase()}"></i> &nbsp; ${
				data.status
			}
		`;
		}
		return this._cells[date_str][time_str];
	}

	enableEditing() {
		this.canEdit = true;
		this._hostElement.classList.add("editing");
	}

	disableEditing() {
		this.canEdit = false;
		this._hostElement.classList.remove("editing");
	}

	onChange(fn) {
		this._onDataChanged = fn;
	}

	onCellSelected(fn) {
		this._onCellSelected = fn;
	}

	async render() {
		this._hostElement.innerHTML = "";

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

			let date =
				`<b style="font-size:1.2em;">${current_date.getDate()}</b>` +
				`<span>${dates[i]}</span>`;

			let w_day = `<b style="font-size:1.2em;">${dates[i]}</b>`;

			this.createCell(
				this.isSchedule ? w_day : date,
				"cell heading fade",
				column
			);

			// await sleep(50);

			for (let i = 8; i < 22; i = i + 0.5) {
				let time_str = `${(Math.floor(i) + "").padStart(2, "0")}:${
					(i % 1) * 6
				}0:00`;

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
		(parent ?? this._hostElement).append(el);
		return el;
	}
}

function sleep(ms) {
	return new Promise((resolve) => setTimeout(resolve, ms));
}
