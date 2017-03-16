var vm = new Vue({

	el: '#vehicle_detail',

	data: {
		
		vehicleData: this.vehicle[0],
		type: this.type,

		vehicleTypes: [
		  { text: 'Vyberte typ vozidla' , value: '0', isDisabled: true },
	      { text: 'Autobus', value: '1', isDisabled: false },
	      { text: 'Nákladní vozidlo', value: '2', isDisabled: false },
	      { text: 'Osobní vozidlo', value: '3', isDisabled: false }
	    ],

	    busTypes: [ 'Autobus', 'Autobus kloubový', 'Tramvaj' ],

		form: new Form({
			vid: '',
			typeOfVehicle: '',
			typeOfBus: '',
	    	maker: '',
	    	model: '',
	    	plateNumber: '',
	    	litresPerKilometer: '',
	    	seats: '',
	    	maxLoadKilos: ''
	    }),

	    isLoading: false

	},

	methods: {

		isBus() {
			return this.form.typeOfVehicle == 1;
		},

		isTruck() {
			return this.form.typeOfVehicle == 2;
		},

		isTram() {
			return this.form.typeOfVehicle == 1 && this.form.typeOfBus == 'Tramvaj';
		},

		printVid() {
			console.log(this.vehicleData);
			console.log(this.vehType);
		},

		fillForm() {
			$vehicle = this.vehicleData;
			this.form.typeOfVehicle = this.type;
			this.form.vid = $vehicle.VID;
			this.form.typeOfBus = $vehicle.typeOfBus;
			this.form.maker = $vehicle.maker;
			this.form.model = $vehicle.model;
			this.form.plateNumber = $vehicle.plateNumber;
			this.form.litresPerKilometer = $vehicle.litresPerKilometer;
			this.form.seats = $vehicle.seats;
			this.form.maxLoadKilos = $vehicle.maxLoadKilos;
		},

		onSubmit() {
			this.isLoading = true;
			this.form.post('/vehicles/edit')
				.then(data => this.onSuccess(data))
				.catch(errors => console.log(errors));
		},

		onSuccess(data) {
			this.isLoading = false;
			console.log(data);
		}
	}


});

vm.printVid();
vm.fillForm();

new Vue({

	el: '#vehicle_journeylog',

	data: {
		
		journeylog: this.journeylog

	}

});