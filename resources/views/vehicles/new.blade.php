@extends('layouts.master')

@section('title')
  Nové vozidlo
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Nové vozidlo</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container" id="add_vehicle">
	  		<form method="POST" action="/vehicles/new" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
	  		
	  		<div class="form-group">
				<label for="vehicleType">Typ vozidla:</label>
				<select class="form-control" v-model="form.selectedTypeOfVehicle">
				  <option v-for="type in vehicleTypes" v-bind:value="type.value" :disabled="type.isDisabled">
				    @{{ type.text }}
				  </option>
				</select>
				<span class="small text-danger" v-if="form.errors.has('selectedTypeOfVehicle')" v-text="form.errors.get('selectedTypeOfVehicle')"></span>
			</div>

			<transition name="slide-fade">
			<div class="form-group" v-show="form.selectedTypeOfVehicle == 1">
				<label for="busType">Typ autobusu:</label>
				<select class="form-control" v-model="form.selectedTypeOfBus">
				  <option v-for="type in busTypes" :disabled="type.isDisabled">
				    @{{ type.text }}
				  </option>
				</select>
			</div>
			</transition>

			<div class="form-group">
				<label for="depot">Depo:</label>
				<select class="form-control" v-model="form.selectedDepot" :disabled="!isSelectedVehicleType()">
				  <option v-for="depot in depots" v-bind:value="depot.BID">
				  	@{{ getNameForDepot(depot.type) + ' ' + depot.address }}
				  </option>
				</select>
			</div>

	  		<div class="form-group">
	  			<label for="maker">Výrobce:</label>
			    <input type="text" class="form-control" id="maker" name="maker" v-model="form.maker" required>
			    <span class="small text-danger" v-if="form.errors.has('maker')" v-text="form.errors.get('maker')"></span>
		 	</div>

		 	<div class="form-group">
	  			<label for="model">Model:</label>
			    <input type="text" class="form-control" id="model" name="model" v-model="form.model" required>
			    <span class="small text-danger" v-if="form.errors.has('model')" v-text="form.errors.get('model')"></span>
		 	</div>

		 	<div class="form-group">
	  			<label for="plateNumber">SPZ:</label>
			    <input type="text" class="form-control" id="plateNumber" name="plateNumber" v-model="form.plateNumber" required>
			    <span class="small text-danger" v-if="form.errors.has('plateNumber')" v-text="form.errors.get('plateNumber')"></span>
		 	</div>

		 	<div class="form-group">
	  			<label for="litresPerKilometer">Spotřeba (l/100km):</label>
			    <input type="text" class="form-control" id="litresPerKilometer" name="litresPerKilometer" v-model="form.litresPerKilometer" required>
			    <span class="small text-danger" v-if="form.errors.has('litresPerKilometer')" v-text="form.errors.get('litresPerKilometer')"></span>
		 	</div>

		 	<transition name="fade">
		 	<div class="form-group" v-if="isSelectedBus() || isSelectedPersonal()">
	  			<label for="seats">Počet míst:</label>
			    <input type="text" class="form-control" id="seats" name="seats" v-model="form.seats" required>
			    <span class="small text-danger" v-if="form.errors.has('seats')" v-text="form.errors.get('seats')"></span>
		 	</div>
		 	</transition>

			<transition name="fade">
		 	<div class="form-group" v-if="isSelectedTruck()">
	  			<label for="maxLoad">Maximální náklad (kg):</label>
			    <input type="text" class="form-control" id="maxLoad" name="maxLoad" v-model="form.maxLoad" required>
			    <span class="small text-danger" v-if="form.errors.has('maxLoad')" v-text="form.errors.get('maxLoad')"></span>
		 	</div>
		 	</transition>

		 	<div class="form-group">
		 		<button type="submit" class="btn btn-primary" :disabled="isSubmitDisabled()">Přidat vozidlo</button>
		 	</div>
	  	</form>
	    </div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var fetchedDepots = {!! $fdepots !!};
	</script>
	<script src="/js/vehicles/new.js"></script>
@endsection