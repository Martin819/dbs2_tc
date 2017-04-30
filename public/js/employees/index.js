new Vue({

	el: '#search_employee',

	data: {

// 		employeePositions: [
// 		  { text: 'Vyberte pozici' , value: '0', isDisabled: true },
// 	      { text: 'Řidič(ka)', value: 'Ridic', isDisabled: false },
// 	      { text: 'Zaměstnanec servisu', value: 'Servis', isDisabled: false },
// 	      { text: 'Management', value: 'Management', isDisabled: false },
// /*	      { text: 'Ostatní', value: '4', isDisabled: false }*/
// 	    ],

		employeePositions: this.positions,

	    form: new Form({
	    	selectedPosition: '',
	    }),

	    position: '',
	    fetchedEmployees: [],
	    isLoading: false
	},

	methods: {
		isSelectedPosition() {
			return this.isSelectedDriver() || this.isSelectedServiceman() || this.isSelectedManagement();
		},
		isSelectedDriver() {
			return this.position == "Řidič(ka)"; 
		},
		isSelectedServiceman() {
			return this.position == "Servis";
		},
		isSelectedManagement() {
			return this.position == "Management";
		},

		isSubmitDisabled() {
			if (this.isLoading) {
				return true;
			} else {
				return !this.isSelectedPosition();
			}
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