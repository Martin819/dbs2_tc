new Vue({

	el: '#search_employee',

	data: {

		branches: this.fetchedBranches,

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
		isSelectedPosition() {
			return this.form.selectedPosition > 0;
		},
		isSelectedDriver() {
			return this.position == "Řidič(ka)";
		},
		isSelectedServiceman() {
			return this.position == "Zaměstnanec servisu";
		},
		isSelectedManagement() {
			return this.position == "Management";
		},
/*		isSelectedTram() {
			return this.position == 1 && this.typeOfBus == 'Tramvaj';
		},	*/
/*		getNameForDepot(type) {
			if (type == 1) {
				return 'Autobusové depo';
			} else if (type == 2) {
				return 'Depo pro nákladní vozy'; 
			} else if (type == 3) {
				return 'Depo pro osobní vozidla';
			}
		},*/
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