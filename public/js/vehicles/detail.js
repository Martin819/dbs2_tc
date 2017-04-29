var vm = new Vue({

	el: '#vehicle_detail',

	data: {
		
		vehicleData: this.vehicle[0],
		type: this.type,

		branches: this.branches,

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
	    	maxLoadKilos: '',
	    	homeBranchID: ''
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
			this.form.homeBranchID = $vehicle.homeBranchID;
		},

		onSubmit() {
			this.isLoading = true;
			this.form.post('/vehicles/edit')
				.then(data => this.onSuccess(data))
				.catch(errors => this.onFail(errors));
		},

		onSuccess(data) {
			this.isLoading = false;
			alert('Vozidlo upraveno.');
			console.log(data);
		},

		onFail(errors) {
			this.isLoading = false;
			alert('POZOR: Všechna pole musí být vyplněna.');
			console.log(errors);
		},

		del(){
			axios.post('/vehicles/delete', {
				'vid': this.form.vid
			})
			.then(function (response){
				console.log(response);
				window.location.href='/vehicles';
			})
			.catch(function(error){
				console.log(error);
			})
		}
	}


});

vm.fillForm();

var jlogdiv = new Vue({

	el: '#vehicle_journeylog',

	data: {
		
		journeylog: this.journeylog,
		from: 0,
		to: 0,
		delta: 20

	},

	computed: {
		selectedlogs() {
			return this.journeylog.slice(this.from, this.to);
		},

		selectionEnd() {
			return this.journeylog.length > this.to ? this.to : this.journeylog.length;
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
			if (this.journeylog.length > this.delta) {
				this.to = this.delta;
			} else {
				this.to = journeylog.length;
			}
		}

	}

});

jlogdiv.prepare();
