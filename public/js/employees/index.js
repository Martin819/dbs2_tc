new Vue({

	el: '#search_employee',

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

	    position: '',
	    fetchedEmployees: [],
	    isLoading: false
	},

	methods: {
		isSelectedPosition() {
			return this.form.selectedPosition > 0;
		},
		isSelectedDriver() {
			return this.position == "Ridic";
		},
		isSelectedServiceman() {
			return this.position == "Servis";
		},
		isSelectedManagement() {
			return this.position == "Management";
		},

		isSubmitDisabled() {
			return !this.isSelectedPosition() || this.form.errors.any()
		},
		isTableVisible() {
			if (this.isLoading) {
				return false
			} else {
				return this.fetchedEmployees.length > 0
			}
		},

		onSubmit() {
			this.isLoading = true;
			this.position = this.form.selectedPosition;
			this.form.post('/employees')
				.then(data => this.fillEmployeesArray(data))
				.catch(errors => console.log(errors));
		},

		fillEmployeesArray(data) {
			console.log(data);
			this.isLoading = false;
			this.fetchedEmployees = data.response;
		}
	}

});