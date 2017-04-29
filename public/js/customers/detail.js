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

	    	cid: '',
	    	firstname: '',
	    	lastname: '',
	    	companyName: '',
	    	companyIdentNr: '',

	    	aid: '',
	    	streetName: '',
	    	houseNr: '',
	    	city: '',
	    	postalCode: ''
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
			this.form.post('/customers/edit')
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
			this.form.cid = this.customer.CID;
			this.form.aid = this.customer.AID;
			this.form.streetName = this.customer.streetName;
			this.form.houseNr = this.customer.houseNr;
			this.form.city = this.customer.city;
			this.form.postalCode = this.customer.postalCode;
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
	},

	methods: {
		showAddInvioceModal() {
			$('#add_invoice_modal').modal('show');
		}
	}

});

var addinvoicemodal = new Vue({

	el: '#add_invoice_form',

	data: {

		form: new Form({
			customerID: this.customer[0].CID,
			type: '',
			startDest: '',
			finalDest: '',
			distance: '',
			price: ''
		})

	},

	methods: {
		onSubmit() {
			this.form.post('/customers/invoices/new')
				.then(data => this.onSuccess(data))
				.catch(errors => this.onFail(errors));
		},

		onSuccess(data) {
			console.log(data);
			window.location.href = '/customers/' + this.form.customerID;
		},

		onFail(errors) {
			console.log(errors);
		}
	}

});
