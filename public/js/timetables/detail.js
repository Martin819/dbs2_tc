var td = new Vue({

	el: '#timetables_detail',

	data: {
		timetable: this.timetable
	},

	computed: {
		monday() {
			return this.getTimetableForDay(1);
		},

		tuesday() {
			return this.getTimetableForDay(2);
		},

		wednesday() {
			return this.getTimetableForDay(3);
		},

		thursday() {
			return this.getTimetableForDay(4);
		},

		friday() {
			return this.getTimetableForDay(5);
		},

		saturday() {
			return this.getTimetableForDay(6);
		},

		sunday() {
			return this.getTimetableForDay(7);
		}

	},

	methods: {
		getTimetableForDay(day) {
			$selected = [];
			for (var i = 0; i < timetable.length; i++) {
				if (timetable[i].dayOfWeek == day) {
					$selected.push(timetable[i]);
				}
			}
			return $selected;
		}
	}

});