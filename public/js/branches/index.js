var branches = new Vue({

	el: '#branches',

	data: {
		depots: this.depots,
		offices: this.offices,
		warehouses: this.warehouses
	},

	methods: {
		getAddressFor(office) {
			return office.streetName + ' ' + office.houseNr + ', ' + office.city + ' ' + office.postalCode
		}
	}

});