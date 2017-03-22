var sc = new Vue({

	el: '#search_customer',

	data: {

		typesOfCustomers: [
		  { text: 'Vyberte typ zákazníka', isDisabled: true },
	      { text: 'Fyzická osoba', isDisabled: false },
	      { text: 'Právnická osoba', isDisabled: false }
	    ],

	    form: new Form({
	    	typeOfCustomer: 'Vyberte typ zákazníka',
	    	firstname: '',
	    	lastname: '',
	    	companyName: '',
	    	companyIdentNr: ''
	    }),

	    fetchedCustomers: [],
	    isLoading: false,
	    typeOfCustomer: ''
	},

	methods: {
		isPerson() {
			return this.typeOfCustomer == 'Fyzická osoba';
		},

		isCompany() {
			return this.typeOfCustomer == 'Právnická osoba';
		},

		isTableVisible() {
			if (this.isLoading) {
				return false
			} else {
				return this.fetchedCustomers.length > 0
			}
		},

		onSubmit() {
			this.typeOfCustomer = this.form.typeOfCustomer;
			this.isLoading = true;
			this.form.post('/customers')
				.then(data => this.fillCustomersArray(data))
				.catch(errors => console.log(errors));
		},

		fillCustomersArray(data) {
			console.log(data.response);
			this.fetchedCustomers = data.response;
			this.isLoading = false;
		}
	}

});