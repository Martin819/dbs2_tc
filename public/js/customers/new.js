new Vue({

	el: '#add_customer',

	data: {
		customerTypes: [
	      { text: 'Fyzická osoba', isDisabled: false },
	      { text: 'Právnická osoba', isDisabled: false }
	    ],

	    selectedTypeOfCustomer: 'Fyzická osoba',

	    form: new Form({
	    	firstname: '',
	    	lastname: '',
	    	companyName: '',
	    	companyIdentNr: '',

	    	streetName: '',
	    	houseNr: '',
	    	city: '',
	    	postalCode: ''
	    })
	},

	methods: {
		onSubmit() {
			if (this.selectedTypeOfCustomer == 'Fyzická osoba') {
				this.form.companyName = '';
				this.form.companyIdentNr = '';
			} else {
				this.form.firstname = '';
				this.form.lastname = '';
			}

			this.form.post('/customers/new')
				.then(data => this.onSuccess(data))
				.catch(errors => this.onFail(errors));
		},

		onSuccess(data) {
			console.log(data);
			window.location.href = '/customers'
		},

		onFail(errors) {
			console.log(errors);
		}

	}

})