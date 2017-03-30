var ed = new Vue({

	el: '#employee_detail',

	data: {

		employeePositions: [
		  { text: 'Vyberte pozici' , value: '0', isDisabled: true },
	      { text: 'Řidič(ka)', value: '1', isDisabled: false },
	      { text: 'Zaměstnanec servisu', value: '2', isDisabled: false },
	      { text: 'Management', value: '3', isDisabled: false },
/*	      { text: 'Ostatní', value: '4', isDisabled: false }*/
	    ],

	    form: new Form({
	    	selectedPosition: '0',
	    }),

	    position: "",
	    fetchedEmployees: [],
	    isLoading: false
	},

	methods: {

		isDriver() {
			return this.form.position == "Ridic";
		},

		isSericeman() {
			return this.form.position == "Servis";
		},

		isManagement() {
			return this.form.position == "Management";
		},

		fillForm() {
			$employee = this.employeeData;
			this.form.position = this.position;
			this.form.eid = $employee.eid;
			this.form.datred = $employee.dateHired;
			this.form.lastTraining = $employee.lastTraining;
			this.form.hourlyWage = $employee.hourlyWage;
			this.form.annualSalary = $employee.annualSalary;
			this.form.fullName = $employee.fullName;
			this.form.address = $employee.address;
			this.form.branchAddress = $employee.branchAddress;
		},

		getNameForType(typeOfAction) {
			if (typeOfAction == 1) {
				return 'Prichod';
			} else if (typeOfAction == 2) {
				return 'Odchod na obed'; 
			} else if (typeOfAction == 3) {
				return 'Navrat z obeda';
			} else if (typeOfAction == 4) {
				return 'Odchod';
			}
		},

		onSubmit() {
			this.isLoading = true;
			this.form.post('/employees/edit')
				.then(data => this.onSuccess(data))
				.catch(errors => this.onFail(errors));
		},

		onSuccess(data) {
			this.isLoading = false;
			alert('Zamestnanec upraven.');
			console.log(data);
		},

		onFail(errors) {
			this.isLoading = false;
			alert('POZOR: Všechna pole musí být vyplněna.');
			console.log(errors);
		},

		del(){
			axios.post('/employees/delete', {
				'eid': this.form.eid
			})
			.then(function (response){
				console.log(response);
				window.location.href='/employees';
			})
			.catch(function(error){
				console.log(error);
			})
		}
	}


});

ed.fillForm();

var wlogdiv = new Vue({

	el: '#employee_workingHoursLogs',

	data: {
		
		workingHoursLogs: this.workingHoursLogs,
		from: 0,
		to: 0,
		delta: 20

	},

	computed: {
		selectedlogs() {
			return this.workingHoursLogs.slice(this.from, this.to);
		},

		selectionEnd() {
			return this.workingHoursLogs.length > this.to ? this.to : this.workingHoursLogs.length;
		}
	},

	methods: {
		previous() {
			this.from = this.from - this.delta;
			this.to = this.to - this.delta;
		},

		next() {
			this.from = this.from + this.delta;
			this.to = this.to + this.delta;
		},

		prepare() {
			if (this.workingHoursLogs.length > this.delta) {
				this.to = this.delta;
			} else {
				this.to = workingHoursLogs.length;
			}
		}

	}

});

wlogdiv.prepare();
