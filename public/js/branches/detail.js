var vm = new Vue({

	el: '#branches_detail',

	data: {
		
		branches: this.branches,
		branchID: this.branchID[0].branchID,
		type: this.type,

		branchesTypes: [
		  { text: 'Vyberte typ pobocky' , value: '0', isDisabled: true },
	      { text: 'Depot', value: '1', isDisabled: false },
	      { text: 'Office', value: '2', isDisabled: false },
	      { text: 'Warehouse', value: '3', isDisabled: false }
	    ],

	    branchesTypes: [ 'Depot', 'Office', 'Warehouse' ],

		form: new Form({
			bid: '',
			typeOfBranches: '',
	    	streetName: '',
	    	houseNr: '',
	    	city: '',
	    	postalCode: '',

	    	id:'',
	    	firstName:'',
	    	lastName:'',
	    	position:'',
	    	dateHired:'',

	    	vid:'',
	    	maker:'',
	    	model:'',
	    	plateNumber:'',
	    	litresPerKilometer:'',

	    	branchID:''
	    }),

	},

	computed: {

		isDepot() {
			return this.form.typeOfBranches == 1;
		},

		isOffice() {
			return this.form.typeOfBranches == 2;
		},

		isWarehouse() {
			return this.form.typeOfBranches == 3;
		}
	},

	methods: {

		fillForm() {
			this.form.typeOfBranches = this.type;
			this.form.branchID = this.branchID;
			this.form.streetName = this.branch.streetName;
			this.form.houseNr = this.branch.houseNr;
			this.form.city = this.branch.city;
			this.form.postalCode= this.branch.postalCode;
			this.form.stateCode=this.branch.stateCode;

			this.form.id = this.employees.id;
			this.form.firstName = this.employees.firstName;
			this.form.lastName = this.employees.lastName;
			this.form.position = this.employees.positon;
			this.form.dateHired = this.employees.dateHired;

			this.form.vid = this.vehicles.vid;
			this.form.maker = this.vehicles.maker;
			this.form.model = this.vehicles.model;
			this.form.plateNumber = this.vehicles.plateNumber;
			this.form.litresPerKilometer = this.vehicles.litresPerKilometer;

		},

		onSubmit() {
			this.isLoading = true;
			this.form.post('/branches/edit')
				.then(data => this.onSuccess(data))
				.catch(errors => this.onFail(errors));
		},

		onSuccess(data) {
			this.isLoading = false;
			alert('Pobocky upraveno.');
			console.log(data);
		},

		onFail(errors) {
			this.isLoading = false;
			alert('POZOR: Všechna pole musí být vyplněna.');
			console.log(errors);
		},

		del(){
			axios.post('/branches/delete', {
				'vid': this.form.vid
			})
			.then(function (response){
				console.log(response);
				window.location.href='/branches';
			})
			.catch(function(error){
				console.log(error);
			})
		}
	}


});

vm.fillForm();
