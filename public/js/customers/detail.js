var cd = new Vue({

	el: '#customer_detail',

	data: {

		companyName: this.companyName,
		customer: this.customer[0],

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
	    })

	},

	computed: {
		isPerson() {
			return this.companyName == '' && this.companyIdentNr == '';
		},

		isCompany() {
			return this.firstname == '' && this.lastname == '';
		}
	},

	methods: {

		onSubmit() {
			this.typeOfCustomer = this.form.typeOfCustomer;
			this.isLoading = true;
			this.form.post('/customers')
				.then(data => console.log(data))
				.catch(errors => console.log(errors));
		},

		printSth() {
			console.log(this.customer);
		}
	}

});

cd.printSth();