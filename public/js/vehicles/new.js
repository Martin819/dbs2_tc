// new Vue({

// 	el: '#add_vehicle_old',

// 	data: {
// 		form: new Form({
// 			maker: '',
// 			model: '',
// 			plateNumber: '',
// 			litresPerKilometer: '',
// 			homeBranchId: ''
// 		})

// 	},

// 	methods: {
// 		onSubmit() {
// 			this.form.post('/vehicles/new')
// 				.then(data => console.log(data))
// 				.catch(errors => console.log(errors));
// 		}
// 	}

// });

new Vue({

	el: '#add_vehicle',

	data: {
		
		depots: this.fetchedDepots,

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
	    	selectedTypeOfBus: '0',
	    	selectedDepot: '',
	    	maker: '',
			model: '',
			plateNumber: '',
			litresPerKilometer: '',
			seats: '',
			maxLoad: ''
	    })
	},

	methods: {
		isSelectedVehicleType() {
			return this.form.selectedTypeOfVehicle > 0
		},
		isSelectedBus() {
			return this.form.selectedTypeOfVehicle == 1
		},
		isSelectedTruck() {
			return this.form.selectedTypeOfVehicle == 2
		},
		isSelectedPersonal() {
			return this.form.selectedTypeOfVehicle == 3
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

		onSubmit() {
			this.form.post('/vehicles/new')
				.then(data => console.log(data))
				.catch(errors => console.log(errors));
		}
	}

});