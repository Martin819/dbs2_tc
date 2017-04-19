@extends('layouts.master')

@section('title')
  Nový zákazník
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Nový zákazník</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container" id="add_customer">
	  		<form method="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
		  		
		  		<div class="row">
		  			<div class="col-lg-4">
		  				<label for="vehicleType">Typ zákazníka:</label>
						<select class="form-control" v-model="selectedTypeOfCustomer">
						  <option v-for="type in customerTypes" v-bind:value="type.text" :disabled="type.isDisabled">
						    @{{ type.text }}
						  </option>
						</select>
		  			</div>

		  			<div class="col-lg-4" v-if="selectedTypeOfCustomer == 'Fyzická osoba'">
		  				<div class="form-group">
				  			<label for="firstname">Jméno:</label>
						    <input type="text" class="form-control" id="firstname" name="firstname" v-model="form.firstname" required>
						    <span class="small text-danger" v-if="form.errors.has('firstname')" v-text="form.errors.get('firstname')"></span>
					 	</div>
		  			</div>

		  			<div class="col-lg-4" v-if="selectedTypeOfCustomer == 'Fyzická osoba'">
		  				<div class="form-group">
				  			<label for="lastname">Příjmení:</label>
						    <input type="text" class="form-control" id="lastname" name="lastname" v-model="form.lastname" required>
						    <span class="small text-danger" v-if="form.errors.has('lastname')" v-text="form.errors.get('lastname')"></span>
					 	</div>
		  			</div>

		  			<div class="col-lg-4" v-if="selectedTypeOfCustomer == 'Právnická osoba'">
		  				<div class="form-group">
				  			<label for="companyName">Název firmy:</label>
						    <input type="text" class="form-control" id="companyName" name="companyName" v-model="form.companyName" required>
						    <span class="small text-danger" v-if="form.errors.has('companyName')" v-text="form.errors.get('companyName')"></span>
					 	</div>
		  			</div>

		  			<div class="col-lg-4" v-if="selectedTypeOfCustomer == 'Právnická osoba'">
		  				<div class="form-group">
				  			<label for="companyIdentNr">IČO:</label>
						    <input type="text" class="form-control" id="companyIdentNr" name="companyIdentNr" v-model="form.companyIdentNr" required>
						    <span class="small text-danger" v-if="form.errors.has('companyIdentNr')" v-text="form.errors.get('companyIdentNr')"></span>
					 	</div>
		  			</div>
		  		</div>

		  		<div class="row">
		  			<div class="col-lg-4">
		  				<div class="form-group">
				  			<label for="streetName">Ulice:</label>
						    <input type="text" class="form-control" id="streetName" name="streetName" v-model="form.streetName" required>
						    <span class="small text-danger" v-if="form.errors.has('streetName')" v-text="form.errors.get('streetName')"></span>
					 	</div>
		  			</div>

		  			<div class="col-lg-2">
		  				<div class="form-group">
				  			<label for="houseNr">Číslo domu:</label>
						    <input type="text" class="form-control" id="houseNr" name="houseNr" v-model="form.houseNr" required>
						    <span class="small text-danger" v-if="form.errors.has('houseNr')" v-text="form.errors.get('houseNr')"></span>
					 	</div>
		  			</div>

		  			<div class="col-lg-4">
		  				<div class="form-group">
				  			<label for="city">Město:</label>
						    <input type="text" class="form-control" id="city" name="city" v-model="form.city" required>
						    <span class="small text-danger" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span>
					 	</div>
		  			</div>

		  			<div class="col-lg-2">
		  				<div class="form-group">
				  			<label for="postalCode">PSČ:</label>
						    <input type="text" class="form-control" id="postalCode" name="postalCode" v-model="form.postalCode" required>
						    <span class="small text-danger" v-if="form.errors.has('postalCode')" v-text="form.errors.get('postalCode')"></span>
					 	</div>
		  			</div>
		  		</div>

		  		<div class="row">
		  			<div class="col-xl-1">
		  				<button type="submit" class="btn btn-primary">Přidat zákazníka</button>
		  			</div>
		  		</div>

	  		</form>
	    </div>
	</div>
@endsection

@section('scripts')
	<script src="/js/customers/new.js"></script>
@endsection