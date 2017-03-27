new Vue({

	el: '#search_employee',

	data: {
	    position: '0',
	    fetchedEmployees: [],
	    isLoading: false
	},

	methods: {
/*		
		getNameForDepot(type) {
			if (type == 1) {
				return 'Autobusové depo';
			} else if (type == 2) {
				return 'Depo pro nákladní vozy'; 
			} else if (type == 3) {
				return 'Depo pro osobní vozidla';
			}
		},
		
		isTableVisible() {
			if (this.isLoading) {
				return false
			} else {
				return this.fetchedEmployees.length > 0
			}
		},
		/*
		onSubmit() {
			this.isLoading = true;
			this.typeOfVehicle = this.form.selectedTypeOfVehicle;
			this.typeOfBus = this.form.selectedTypeOfBus;
			this.form.post('/vehicles')
				.then(data => this.fillVehiclesArray(data))
				.catch(errors => console.log(errors));
		},
*/
		fillEmployeesArray(data) {
			console.log(data); 
			this.isLoading = false;
			this.fetchedEmployees = data.response;
		}
	}

});