@extends('layouts.master')

@section('title')
  Pobočky
@endsection

@section('content')
<div id="branch_detail">
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3" v-text="title"></h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container">
			<table class="table table-sm borderless">
				<tbody>
					<tr><th>ID:</th><td v-text="branch.BID"></td></tr>
					<tr><th>Adresa:</th><td v-text="concatAddress"></td></tr>
					<tr v-if="branch.type==1"><th>Oddělení:</th><td v-text="concatDepartments"></td></tr>
				</tbody>
			</table>
	    </div>
	</div>

	<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Zaměstnanci pobočky</h2>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container">
	    	<table class="table table-hover borderless" v-if="employees.length > 0">
	    		<thead>
	    			<th>Jméno</th>
	    			<th>Pozice</th>
	    			<th style="width:1%;"></th>
	    		</thead>
	    		<tbody>
	    			<tr v-for="employee in employees">
	    				<td v-text="employee.firstName + ' ' + employee.lastName"></td>
	    				<td v-text="employee.position"></td>
	    				<td><a class="btn btn-info" v-bind:href="'/employees/' + employee.EID">Detail</a></td>
	    			</tr>
	    		</tbody>
	    	</table>

	    	<div v-if="employees.length < 1"><p>Tato pobočka nemá žádné zaměstnance.</p></div>
	    </div>
	</div>

	<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Vozidla pobočky</h2>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container">
	    	<table class="table table-hover borderless" v-if="vehicles.length > 0">
	    		<thead>
	    			<th>Typ</th>
	    			<th>Značka</th>
	    			<th>Model</th>
	    			<th>SPZ</th>
	    			<th style="width:1%;"></th>
	    		</thead>
	    		<tbody>
	    			<tr v-for="vehicle in vehicles">
	    				<td v-text="getTypeFor(vehicle)"></td>
	    				<td v-text="vehicle.maker"></td>
	    				<td v-text="vehicle.model"></td>
	    				<td v-text="vehicle.plateNumber"></td>
	    				<td><a class="btn btn-info" v-bind:href="'/vehicles/' + vehicle.VID">Detail</a></td>
	    			</tr>
	    		</tbody>
	    	</table>

	    	<div v-if="vehicles.length < 1"><p>Tato pobočka nemá žádná vozidla.</p></div>
	    </div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var branch = {!! $branch !!};
		var departments = {!! $departments !!};
		var employees = {!! $employees !!};
		var vehicles = {!! $vehicles !!};
	</script>
	<script src="/js/branches/detail.js"></script>
@endsection