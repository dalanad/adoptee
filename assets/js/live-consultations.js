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

	constructor(hostElement) {
		this._hostElement = hostElement;
		this.render();
	}

	async render() {
		this._hostElement.innerHTML = "";
		// time
		let time_col = this.createEl(
			"<div class='cell heading' style='height:4em'><i class='far fa-clock'></i></div>"
		);
		time_col.classList.add("timeline-column");

		for (let i = 8; i < 22; i++) {
			let time_cell = this.createEl(`${i}.00`, time_col);
			time_cell.classList = "heading cell";
			time_cell.style.minHeight = "4em";
		}

		// date headers
		let current_date = new Date(this._date);
		current_date.setDate(
			current_date.getDate() - ((current_date.getDay() + 6) % 7)
		);

		let dates = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

		for (let i = 0; i < 7; i++) {
			let column = this.createEl("");
			column.classList.add("timeline-column");
			column.classList.add("fade");

			if (current_date.getDate() == this._date.getDate()) {
				column.classList.add("active");
				column.scrollIntoView({
					behavior: "auto",
					block: "center",
					inline: "center",
				});
			}

			let date = this.createEl(
				`<span style="font-size:1.2em;font-weight:500">${current_date.getDate()}</span> 
                 <span>${dates[i]}</span>`,
				column
			);
			date.classList = "cell heading";
			date.style.height = "4em";

			await sleep(50);

			for (let i = 8; i < 22; i = i + 0.5) {
				this.createEl(``, column).classList.add("cell");
			}
			current_date.setDate(current_date.getDate() + 1);
		}
	}

	createEl(text, parent) {
		let el = document.createElement("div");
		el.innerHTML = text;
		(parent ?? this._hostElement).append(el);
		return el;
	}
}

let cal_el = document.querySelector(".calender");
let cal = new Calender(cal_el);

let appointments_timeline = document.getElementById("appointments-timeline");

let timeline = new AppointmentsTimeline(appointments_timeline);

cal.onChange(() => {
	timeline._date = cal._date;
	timeline.render();
});

function sleep(ms) {
	return new Promise((resolve) => setTimeout(resolve, ms));
}
