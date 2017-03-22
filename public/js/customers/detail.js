var cd = new Vue({

	el: '#customer_detail',

	data: {

		companyName: this.companyName,
		customer: this.customer[0],
		contracts: this.contracts,

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
			return this.form.typeOfCustomer == this.typesOfCustomers[1].text;
		},

		isCompany() {
			return this.form.typeOfCustomer == this.typesOfCustomers[2].text;
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

		fillForm() {
			if (this.customer.companyName == '') {
				this.form.typeOfCustomer = this.typesOfCustomers[1].text;
				this.form.firstname = this.customer.firstName;
				this.form.lastname = this.customer.lastname;
			} else {
				this.form.typeOfCustomer = this.typesOfCustomers[2].text;
				this.form.companyName = this.customer.companyName;
				this.form.companyIdentNr = this.customer.companyIdentNr;
			}
		},

		printSth() {
			console.log(this.customer);
			console.log(this.contracts);
		}
	}

});

cd.printSth();
cd.fillForm();

var ci = new Vue({

	el: '#customer_invoices',

	data: {

		contracts: this.contracts

	},

	computed: {
		isPerson() {
			return this.form.typeOfCustomer == this.typesOfCustomers[1].text;
		},

		isCompany() {
			return this.form.typeOfCustomer == this.typesOfCustomers[2].text;
		}
	}

});
