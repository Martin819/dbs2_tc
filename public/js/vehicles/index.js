new Vue({

	el: '#search_vehicle',

	data: {
		
		depots: this.fetchedBranches,

		vehicleTypes: [
		  { text: 'Vyberte typ vozidla' , value: '0', isDisabled: true },
	      { text: 'Autobus', value: '1', isDisabled: false },
	      { text: 'Nákladní vozidlo', value: '2', isDisabled: false },
	      { text: 'Osobní vozidlo', value: '3', isDisabled: false }
	    ],

	    busTypes: [
	 	  { text: 'Vyberte typ autobusu' , value: '0', isDisabled: true },
	      { text: 'Autobus', value: '1', isDisabled: false },
	      { text: 'Autobus kloubový', value: '2', isDisabled: false },
	      { text: 'Tramvaj', value: '3', isDisabled: false }
	    ],

	    form: new Form({
	    	selectedTypeOfVehicle: '0',
	    	selectedTypeOfBus: '0'
	    }),

	    typeOfVehicle: '0',
	    typeOfBus: '0',
	    fetchedVehicles: [],
	    isLoading: false
	},

	methods: {
		isSelectedVehicleType() {
			return this.form.selectedTypeOfVehicle > 0;
		},
		isSelectedBus() {
			return this.typeOfVehicle == 1;
		},
		isSelectedTruck() {
			return this.typeOfVehicle == 2;
		},
		isSelectedPersonal() {
			return this.typeOfVehicle == 3;
		},
		isSelectedTram() {
			return this.typeOfVehicle == 1 && this.typeOfBus == 'Tramvaj';
		},	
		getNameForDepot(type) {
			if (type == 1) {
				return 'Autobusové depo';
			} else if (type == 2) {
				return 'Depo pro nákladní vozy'; 
			} else if (type == 3) {
				return 'Depo pro osobní vozidla';
			}
		},
		isSubmitDisabled() {
			return !this.isSelectedVehicleType() || this.form.errors.any()
		},
		isTableVisible() {
			if (this.isLoading) {
				return false
			} else {
				return this.fetchedVehicles.length > 0
			}
		},

		onSubmit() {
			this.isLoading = true;
			this.typeOfVehicle = this.form.selectedTypeOfVehicle;
			this.typeOfBus = this.form.selectedTypeOfBus;
			this.form.post('/vehicles')
				.then(data => this.fillVehiclesArray(data))
				.catch(errors => console.log(errors));
		},

		fillVehiclesArray(data) {
			console.log(data);
			this.isLoading = false;
			this.fetchedVehicles = data.response;
		}
	}

});