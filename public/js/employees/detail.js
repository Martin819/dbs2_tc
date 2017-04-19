var employee_detail = new Vue({

	el: '#employee_detail',

	data: {
		employee: this.employee[0],

		employeePositions: this.positions,

		form: new Form({
			eid: '',
			position: '',
			firstname: '',
			lastname: '',

			dateHired: '',
	    	hourlyWage: '',
	    	annualSalary: '',
	    	lastTraining: '',

			aid: '',
	    	streetName: '',
	    	houseNr: '',
	    	city: '',
	    	postalCode: '',

	    	formerPosition: ''
		})
	},

	mounted() {
		this.fillForm();
	},

	computed: {
		isDriver() {
			return this.form.position == 'Ridic';
		},

		isServiceman() {
			return this.form.position == 'Servis';
		},

		isManagement() {
			return !this.isDriver && !this.isServiceman;
		}
	},

	methods: {
		fillForm() {
			this.form.formerPosition = this.employee.position;

			this.form.eid = this.employee.EID;
			this.form.position = this.employee.position;
			this.form.firstname = this.employee.firstName;
			this.form.lastname = this.employee.lastName;

			this.form.dateHired = this.employee.dateHired;
			this.form.hourlyWage = this.employee.hourlyWage;
			this.form.annualSalary = this.employee.annualSalary;
			this.form.lastTraining = this.employee.lastTraining;

			this.form.aid = this.employee.AID;
			this.form.streetName = this.employee.streetName;
			this.form.houseNr = this.employee.houseNr;
			this.form.city = this.employee.city;
			this.form.postalCode = this.employee.postalCode;
		},

		onSubmit() {
			this.form.post('/employees/edit')
				.then(data => console.log(data))
				.catch(errors => console.log(errors));
		}
	}

});


// var ed = new Vue({

// 	el: '#employee_detail',

// 	data: {

// 		employee: this.employee,

// 		employeePositions: [
// 		  { text: 'Vyberte pozici' , value: '0', isDisabled: true },
// 	      { text: 'Řidič(ka)', value: '1', isDisabled: false },
// 	      { text: 'Zaměstnanec servisu', value: '2', isDisabled: false },
// 	      { text: 'Management', value: '3', isDisabled: false },
// /*	      { text: 'Ostatní', value: '4', isDisabled: false }*/
// 	    ],

// 	    form: new Form({
// 	    	selectedPosition: '0',

// 	    	eid: '',
// 	    	dateHired: '',
// 	    	lastTraining: '',
// 	    	hourlyWage: '',
// 	    	annualSalary: '',
// 	    	fullName: '',
// 	    	address: '',
// 	    	branchAddress: ''
// 	    }),

// 	    position: '',
// 	    fetchedEmployees: [],
// 	    isLoading: false
// 	},

// 	mounted() {
// 		this.fillForm();
// 	},

// 	methods: {

// 		isDriver() {
// 			return this.form.position == "Ridic";
// 		},

// 		isSericeman() {
// 			return this.form.position == "Servis";
// 		},

// 		isManagement() {
// 			return this.form.position == "Management";
// 		},

// 		fillForm() {
// 			this.form.position = this.position;
// 			this.form.eid = this.employee.eid;
// 			this.form.datHired = this.employee.dateHired;
// 			this.form.lastTraining = this.employee.lastTraining;
// 			this.form.hourlyWage = this.employee.hourlyWage;
// 			this.form.annualSalary = this.employee.annualSalary;
// 			this.form.fullName = this.employee.fullName;
// 			this.form.address = this.employee.address;
// 			this.form.branchAddress = this.employee.branchAddress;
// 		},

// 		getNameForType(typeOfAction) {
// 			if (typeOfAction == 1) {
// 				return 'Prichod';
// 			} else if (typeOfAction == 2) {
// 				return 'Odchod na obed'; 
// 			} else if (typeOfAction == 3) {
// 				return 'Navrat z obeda';
// 			} else if (typeOfAction == 4) {
// 				return 'Odchod';
// 			}
// 		},

// 		onSubmit() {
// 			this.isLoading = true;
// 			this.form.post('/employees/edit')
// 				.then(data => this.onSuccess(data))
// 				.catch(errors => this.onFail(errors));
// 		},

// 		onSuccess(data) {
// 			this.isLoading = false;
// 			alert('Zamestnanec upraven.');
// 			console.log(data);
// 		},

// 		onFail(errors) {
// 			this.isLoading = false;
// 			alert('POZOR: Všechna pole musí být vyplněna.');
// 			console.log(errors);
// 		},

// 		del(){
// 			axios.post('/employees/delete', {
// 				'eid': this.form.eid
// 			})
// 			.then(function (response){
// 				console.log(response);
// 				window.location.href='/employees';
// 			})
// 			.catch(function(error){
// 				console.log(error);
// 			})
// 		}
// 	}


// });

// var wlogdiv = new Vue({

// 	el: '#employee_workingHoursLogs',

// 	data: {
		
// 		workingHoursLogs: this.workingHoursLogs,
// 		from: 0,
// 		to: 0,
// 		delta: 20

// 	},

// 	mounted() {
// 		this.prepare();
// 	},

// 	computed: {
// 		selectedlogs() {
// 			return this.workingHoursLogs.slice(this.from, this.to);
// 		},

// 		selectionEnd() {
// 			return this.workingHoursLogs.length > this.to ? this.to : this.workingHoursLogs.length;
// 		}
// 	},

// 	methods: {
// 		previous() {
// 			this.from = this.from - this.delta;
// 			this.to = this.to - this.delta;
// 		},

// 		next() {
// 			this.from = this.from + this.delta;
// 			this.to = this.to + this.delta;
// 		},

// 		prepare() {
// 			if (this.workingHoursLogs.length > this.delta) {
// 				this.to = this.delta;
// 			} else {
// 				this.to = workingHoursLogs.length;
// 			}
// 		}

// 	}

// });
