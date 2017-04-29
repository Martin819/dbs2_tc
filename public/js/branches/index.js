new Vue({

	el: '#search_branches',

	data: {

		branches: this.fetchedBranches,

		branchesType: [
		  { text: 'Vyberte typ pobočky:' , value: '0', isDisabled: true },
	      { text: 'Depot', value: '1', isDisabled: false },
	      { text: 'Office', value: '2', isDisabled: false },
	      { text: 'Warehouse', value: '3', isDisabled: false },
/*	      { text: 'Ostatní', value: '4', isDisabled: false }*/
	    ],

	    form: new Form({
	    	selectedTypeOfBranches: '0',
	    }),

	    typeOfBranches: '',
	    fetchedBranches: [],
	    isLoading: false
	},

	methods: {
		isSelectedTypeOfBranches() {
			return this.form.selectedTypeOfBranches > 0;
		},
		isSelectedDepot() {
			return this.typeOfBranches == "Depo";
		},
		isSelectedOffice() {
			return this.typeOfBranches == "Kancelář";
		},
		isSelectedWarehouse() {
			return this.typeOfBranches == "Sklad";
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
			return !this.isSelectedTypeOfBranches() || this.form.errors.any()
		},
		isTableVisible() {
			if (this.isLoading) {
				return false
			} else {
				return this.fetchedBranches.length > 0
			}
		},

		onSubmit() {
			this.isLoading = true;
			this.form.selectedTypeOfBranches = this.typeOfBranches;
			this.form.post('/branches')
				.then(data => this.fillBranchesArray(data))
				.catch(errors => console.log(errors));
		},

		fillBranchesArray(data) {
			console.log(data);
			this.isLoading = false;
			this.fetchedBranches = data.response;
		}
	}

});