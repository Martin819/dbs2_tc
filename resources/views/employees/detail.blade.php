@extends('layouts.master')

@section('title')
  Detail zaměstnance
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Detail zaměstnance</h1>
	  </div>
	</div>

	<div class="jumbotron content_container" id="employee_detail">
		<div class="container">
			<form method="POST" @submit.prevent="onSubmit">
				<div class="row">
							
					<div class="col-md-4">
						<div class="form-group">
				  			<label for="position">Pozice:</label>
							<select class="form-control" v-model="form.position">
							  <option v-for="type in employeePositions" v-bind:value="type.position" :disabled="type.isDisabled">
							    @{{ type.position }}
							  </option>
							</select>
					 	</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
				  			<label for="firstname">Jméno:</label>
						    <input type="text" class="form-control" id="firstname" name="firstname" v-model="form.firstname" required>
						    <span class="small text-danger" v-if="form.errors.has('firstname')" v-text="form.errors.get('firstname')"></span>
					 	</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
				  			<label for="lastname">Příjmení:</label>
						    <input type="text" class="form-control" id="lastname" name="lastname" v-model="form.lastname" required>
						    <span class="small text-danger" v-if="form.errors.has('lastname')" v-text="form.errors.get('lastname')"></span>
					 	</div>
					</div>

				</div>

				<div class="row">
					
					<div :class="!isDriver ? 'col-md-6' : 'col-md-4'">
						<div class="form-group">
				  			<label for="dateHired">Datum nástupu:</label>
						    <input type="text" class="form-control" id="dateHired" name="dateHired" v-model="form.dateHired" disabled>
					 	</div>
					</div>

					<div :class="!isDriver ? 'col-md-6' : 'col-md-4'" v-if="!isManagement">
						<div class="form-group">
				  			<label for="hourlyWage">Hodinová mzda:</label>
						    <input type="text" class="form-control" id="hourlyWage" name="hourlyWage" v-model="form.hourlyWage" required>
						    <span class="small text-danger" v-if="form.errors.has('hourlyWage')" v-text="form.errors.get('hourlyWage')"></span>
					 	</div>
					</div>

					<div class="col-md-4" v-if="isDriver">
						<div class="form-group">
				  			<label for="lastTraining">Poslední trénink:</label>
						    <input type="text" class="form-control" id="lastTraining" name="lastTraining" v-model="form.lastTraining" required>
						    <span class="small text-danger" v-if="form.errors.has('lastTraining')" v-text="form.errors.get('lastTraining')"></span>
					 	</div>
					</div>

					<div class="col-md-6" v-if="isManagement">
						<div class="form-group">
				  			<label for="annualSalary">Roční mzda:</label>
						    <input type="text" class="form-control" id="annualSalary" name="annualSalary" v-model="form.annualSalary" required>
						    <span class="small text-danger" v-if="form.errors.has('annualSalary')" v-text="form.errors.get('annualSalary')"></span>
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

				<div class="row" style="margin-right: 0px;">

					<div class="col-md-1">
						<button type="submit" class="btn btn-primary">Uložit</button>
					</div>

					<a class="btn btn-danger ml-auto" href="#">Smazat zaměstnance</a>
					
				</div>

			</form>	
		</div>
	</div>

{{-- 	<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Zakázky</h2>
	  </div>
	</div>

	<div class="jumbotron content_container" id="customer_invoices">
		<div class="container">
			<table class="table table-hover borderless">

		      <thead>
		        <tr>
		        	<th>Počáteční adresa:</th>
		        	<th>Cílová adresa:</th>
		        	<th>Vzdálenost:</th>
		        	<th>Typ:</th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="contract in contracts">
		      		<td v-text="contract.startDest"></td>
		      		<td v-text="contract.finalDest"></td>
		      		<td v-text="contract.distance + ' km'"></td>
		      		<td v-text="contract.type"></td>
		      	</tr>
		      </tbody>

		    </table>
		</div>
	</div> --}}

@endsection

@section('scripts')
	<script type="text/javascript">
		var employee = {!! $employee !!};
		var workingHoursLogs = {!! $workingHoursLogs !!};
		var positions = {!! $positions !!};
	</script>
	<script src="/js/employees/detail.js"></script>
@endsection