@extends('layouts.master')

@section('title')
  Zákazníci
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Zákazníci</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container" id="search_customer">

			<div class="row" style="margin-left: 0px; margin-right: 0px;">

			<form class="form-inline" method="POST" action="/customers" @submit.prevent="onSubmit">

				<transition name="fade">
				<select class="form-control mb-2 mr-sm-2 mb-sm-0" v-model="form.typeOfCustomer">
				  <option v-for="type in typesOfCustomers" v-text="type.text" :disabled="type.isDisabled"></option>
				</select>
				</transition>

				<div class="form-group mb-2 mr-sm-2 mb-sm-0" v-if="form.typeOfCustomer == 'Fyzická osoba'">
				<input type="text" class="form-control" id="firstname" name="firstname" v-model="form.firstname" placeholder="Jméno">
				</div>

				<div class="form-group mb-2 mr-sm-2 mb-sm-0" v-if="form.typeOfCustomer == 'Fyzická osoba'">
				<input type="text" class="form-control" id="lastname" name="lastname" v-model="form.lastname" placeholder="Přijmení">
				</div>

				<div class="form-group mb-2 mr-sm-2 mb-sm-0" v-if="form.typeOfCustomer == 'Právnická osoba'">
				<input type="text" class="form-control" id="companyName" name="companyName" v-model="form.companyName" placeholder="Název firmy">
				</div>

				<div class="form-group mb-2 mr-sm-2 mb-sm-0" v-if="form.typeOfCustomer == 'Právnická osoba'">
				<input type="text" class="form-control" id="companyIdentNr" name="companyIdentNr" v-model="form.companyIdentNr" placeholder="ID firmy">
				</div>

			  <button type="submit" class="btn btn-primary mb-2 mr-sm-2 mb-sm-0">Hledat</button>

	  		</form>	

	  		<a class="btn btn-warning ml-auto" href="/customers/new">Přidat nového zákazníka</a>

	  		</div>

	  		<transition name="fade">
	  		<table class="table table-hover borderless" style="margin-top: 50px;" v-if="isTableVisible()">

		      <thead>
		        <tr>
		         	<th v-if="isPerson()">Jmeno</th>
		         	<th v-if="isPerson()">Prijmeni</th>
		         	<th v-if="isCompany()">Nazev firmy</th>
		         	<th v-if="isCompany()">ID firmy</th>
		         	<th style="width:1%;"></th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="customer in fetchedCustomers">
		      		<td v-if="isPerson()" v-text="customer.firstName"></td>
		      		<td v-if="isPerson()" v-text="customer.lastname"></td>
		      		<td v-if="isCompany()" v-text="customer.companyName"></td>
		      		<td v-if="isCompany()" v-text="customer.companyIdentNr"></td>
		      		<td><a class="btn btn-info" v-bind:href="'/customers/' + customer.CID">Detail</a></td>
		      	</tr>
		      </tbody>

		    </table>
		    </transition>

		    <transition name="fade">
		    <div class="row justify-content-center" style="margin-top: 50px;" v-if="isLoading">
		    	@include('layouts.activity_indicator')
		    </div>  
		    </transition>		

	    </div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">

	</script>
	<script src="/js/customers/index.js"></script>
@endsection