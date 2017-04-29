var vm = new Vue({

	el: '#branches_detail',

	data: {
		
		branchesData: this.branches[0],
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
	    }),

	    isLoading: false

	},

	methods: {

		isDepot() {
			return this.form.typeOfBranches == 1;
		},

		isOffice() {
			return this.form.typeOfBranches == 2;
		},

		isWarehouse() {
			return this.form.typeOfBranches == 1;
		},

		fillForm() {
			$branches = this.branchesData;
			this.form.typeOfBranches = this.type;
			this.form.bid = $branches.BID;
			this.form.streetName = $branches.streetName;
			this.form.houseNr = $branches.houseNr;
			this.form.city = $branches.city;
			this.form.postalCode= $branches.postalCode;
			this.form.stateCode=$branches.stateCode;
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
