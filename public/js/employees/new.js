var newemployee = new Vue({

	el: '#new_employee',

	data: {

		positions: [
			'Finanční ředitel', 
			'Generální ředitel', 
			'Management', 
			'Poradce poradce ředitele', 
			'Poradce ředitele', 
			'Recepční',
			'Řidič(ka)',
			'Servis',
			'Výkonný ředitel'
		],

		branches: this.branches,

		form: new Form({
			position: '',
			branchID: '',
			firstname: '',
			lastname: '',

			dateHired: '',
	    	hourlyWage: '',
	    	annualSalary: '',
	    	lastTraining: '',

	    	streetName: '',
	    	houseNr: '',
	    	city: '',
	    	postalCode: ''
		})

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
		onSubmit() {
			this.form.post('/employees/new')
				.then(data => this.onSuccess(data))
				.catch(errors => this.onFail(errors));
		},

		onSuccess(data) {
			console.log(data);
			window.location.href = '/employees';
		},

		onFail(errors) {
			console.log(errors);
		}
	}

});