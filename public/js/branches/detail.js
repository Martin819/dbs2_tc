var detail = new Vue({

	el: '#branch_detail',

	data: {
		branch: this.branch[0],
		departments: this.departments,
		employees: this.employees,
		vehicles: this.vehicles
	},

	computed: {
		concatAddress() {
			return this.branch.streetName + ' ' + this.branch.houseNr + ', ' + this.branch.city + ' ' + this.branch.postalCode 
		},

		concatDepartments() {
			var string = '';
			for (var i = 0; i < departments.length; i++) {
				if (i > 0) {
					string = string + ', ';
				}
				string = string + departments[i].name;
			}
			return string;
		},

		title() {
			if (this.branch.type == 1) {
				return this.branch.name;
			} else if (this.branch.type == 2) {
				return 'Skladiště';
			} else {
				return 'Depo';
			}
		}
	},

	methods: {
		getTypeFor(vehicle) {
			if (vehicle.type == 1) {
				return 'Autobus';
			} else if (vehicle.type == 2) {
				return 'Nákladní vozidlo';
			} else {
				return 'Osobní vozidlo';
			}
		}
	}

});