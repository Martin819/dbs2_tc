@extends('layouts.master')

@section('title')
  Detail pobočky
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Detail pobočky</h1>
	  </div>
	</div>

	
	<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Detail pobočky</h2>
	  </div>
	</div>

	<div class="jumbotron content_container" id="branch">
		<div class="container">
			<table class="table table-hover borderless">

		      <thead>
		        <tr>
		        	<th>ID pobočky:</th>
		        	<th>Ulice:</th>
		        	<th>Číslo domu:</th>
		        	<th>Město:</th>
		        	<th>PSČ:</th>
		        	<th>Stát:</th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="branch in fetchedBranches">
		      		<td v-text="branch.branchID"></td>
		      		<td v-text="branch.streetName"></td>
		      		<td v-text="branch.houseNr"></td>
		      		<td v-text="branch.city"></td>
		      		<td v-text="branch.postalCode"></td>
		      		<td v-text="branch.stateCode"></td>
		      	</tr>
		      </tbody>
			</table>
		</div>
	</div>





<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Zaměstnanci pobočky</h2>
	  </div>
	</div>


	<div class="jumbotron content_container" id="employees">
		<div class="container">
			<table class="table table-hover borderless">

		      <thead>
		        <tr>
		        	<th>ID zaměstnance:</th>
		        	<th>Jméno:</th>
		        	<th>Přijmení:</th>
		        	<th>Pozice:</th>
		        	<th>Datum nástupu:</th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="employees in fetchedBranches">
		      		<td v-text="employees.employees.id"></td>
		      		<td v-text="employees.firstName"></td>
		      		<td v-text="employees.lastName"></td>
		      		<td v-text="employees.positon"></td>
		      		<td v-text="employees.dateHired"></td>
		      	</tr>
		      </tbody>
			</table>
		</div>
	</div>





	<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Vozidla pobočky</h2>
	  </div>
	</div>


	<div class="jumbotron content_container" id="vehicles">
		<div class="container">
			<table class="table table-hover borderless">

		      <thead>
		        <tr>
		        	<th>ID vozidla:</th>
		        	<th>Výrobce:</th>
		        	<th>Model:</th>
		        	<th>SPZ:</th>
		        	<th>Spotřeba:</th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="employees in fetchedBranches">
		      		<td v-text="vehicles.vehicles.vid"></td>
		      		<td v-text="vehicles.vehicles.maker"></td>
		      		<td v-text="vehicles.vehicles.model"></td>
		      		<td v-text="vehicles.vehicles.plateNumber"></td>
		      		<td v-text="vehicles.vehicles.litresPerKilometer"></td>
		      	</tr>
		      </tbody>
			</table>
		</div>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		var employees = {!! $employees !!};
		var vehicles = {!! $vehicles !!};
		var branch = {!! $branch !!};
		var branches = {!! $branches !!};
		var branchID = {!! $branchID !!};
	</script>
	<script src="/js/branches/detail.js"></script>
@endsection