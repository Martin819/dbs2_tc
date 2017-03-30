@extends('layouts.master')

@section('title')
  Detail zamestnance
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Detail zamestnance</h1>
	  </div>
	</div>

	<div class="jumbotron content_container" id="employee_detail">
		<div class="container">
			<form method="POST" action="/employees/edit" @submit.prevent="onSubmit">

				<div class="row">

					<div class="col-md-1">
						<div class="form-group">
				  			<label for="eid">ID:</label>
						    <input type="text" class="form-control" id="eid" name="eid" v-model="form.eid">
					 	</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
				  			<label for="fullName">Cele jmeno:</label>
						    <input type="text" class="form-control" id="fullName" name="fullName" v-model="form.fullName">
					 	</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
				  			<label for="position">Pozice:</label>
							<select class="form-control" v-model="form.position" disabled="true">
							  <option v-for="position in employeePositions" v-bind:value="position.value" :disabled="position.isDisabled">
							    @{{ position.text }}
							  </option>
							</select>
					 	</div>
					</div>

				</div>

				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">
				  			<label for="address">Bydliste:</label>
						    <input type="text" class="form-control" id="address" name="address" v-model="form.address">
					 	</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
				  			<label for="dateHired">Datum nastupu:</label>
						    <input type="text" class="form-control" id="dateHired" name="dateHired" v-model="form.dateHired">
					 	</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
				  			<label for="branchAddress">Pobocka:</label>
						    <input type="text" class="form-control" id="branchAddress" name="branchAddress" v-model="form.branchAddress">
					 	</div>
					</div>

				</div>

				<div class="row">
					
					<div class="col-md-4" v-if="!isManagement()">
						<div class="form-group">
				  			<label for="hourlyWage">Hodinova mzda:</label>
						    <input type="text" class="form-control" id="hourlyWage" name="hourlyWage" v-model="form.hourlyWage">
					 	</div>
					</div>

					<div class="col-md-4" v-if="isManagement()">
						<div class="form-group">
				  			<label for="annualSalary">Rocni plat:</label>
						    <input type="text" class="form-control" id="annualSalary" name="annualSalary" v-model="form.annualSalary">
					 	</div>
					</div>

					<div class="col-md-4" v-if="isDriver()">
						<div class="form-group">
				  			<label for="lastTraining">Posledni skoleni:</label>
						    <input type="text" class="form-control" id="lastTraining" name="lastTraining" v-model="form.lastTraining">
					 	</div>
					</div>

				</div>

				<div class="row" style="margin-right: 0px;">
					
					<div class="col-md-1">
						<button type="submit" class="btn btn-primary" :disabled="isLoading"><img src="../img/save.png" style="width:24px;height:24px;"> Uložit</button>
					</div>

					
					<div class="col-md-5" style="height: 40px;">
						<div v-if="isLoading">
							<transition name="fade">
								@include('layouts.activity_indicator_small')
							</transition>
						</div>
					</div>
					<a class="btn btn-danger" href="#" v-on:click="del()"><img src="../img/delete.png" style="width:24px;height:24px;"> Smazat</a>
				</div>
			</form>	
		</div>
	</div>

	<div class="jumbotron">
  <div class="container">
    <h2 class="display-3">Pracovni denik</h2>
  </div>
</div>

<div class="jumbotron content_container" id="employee_workingHoursLogs">
	<div class="container">
		<table class="table table-hover borderless" v-if="workingHoursLogs.length > 0">

	      <thead>
	        <tr>
	        	<th>Datum:</th>
	        	<th>Cas:</th>
	        	<th>Typ akce:</th>
	        </tr>
	      </thead>

	      <tbody>
	      	<tr v-for="log in selectedworkinglogs">
	      		<td v-text="log.dateOfAction"></td>
	      		<td v-text="log.timeOfAction"></td>
	      		<td>@{{ getNameForType(log.typeOfAction) }}</td>
	      	</tr>
	      </tbody>

	    </table>

	    <label v-if="workingHoursLogs.length < 1" style="color: #BBBBBB">Pro tohoto zamestnance neexistují žádné záznamy.</label>

	    <div class="row" v-if="workingHoursLogs.length > 0">
	    	<div class="col-md-9">
	    		<label v-text="'Zobrazeny záznamy od: '+from+' do: '+selectionEnd" style="color: #BBBBBB"></label>
	    	</div>
	    	
	    	<div class="col-xl-3">
	    		<button class="btn btn-primary ml-auto" :disabled="from <= 0" @click="previous">Předchozí</button>
	    		<button class="btn btn-primary ml-auto" :disabled="to >= workingHoursLogs.length" @click="next">Následující</button>
	    	</div>
	    </div>
	</div>
</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		var employee = {!! $employee !!};
		var position = {!! $position !!};
		var workingHoursLogs = {!! $workingHoursLogs !!};
	</script>
	<script src="/js/employees/detail.js"></script>
	<link href="/css/vehicle_detail.css" rel="stylesheet">
@endsection