@extends('layouts.master')

@section('title')
  Vozidla
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Vozidla</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container" id="search_vehicle">

			<div class="row" style="margin-left: 0px; margin-right: 0px;">

			<form class="form-inline" method="POST" action="/vehicles" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
	  		
			 	<select class="form-control mb-2 mr-sm-2 mb-sm-0" v-model="form.selectedTypeOfVehicle">
				  <option v-for="type in vehicleTypes" v-bind:value="type.value" :disabled="type.isDisabled">
				    @{{ type.text }}
				  </option>
				</select>

				<transition name="fade">
				<select class="form-control mb-2 mr-sm-2 mb-sm-0" v-model="form.selectedTypeOfBus" v-if="form.selectedTypeOfVehicle == 1">
				  <option v-for="type in busTypes" :disabled="type.isDisabled">
				    @{{ type.text }}
				  </option>
				</select>
				</transition>

			  <button type="submit" class="btn btn-primary mb-2 mr-sm-2 mb-sm-0" :disabled="isSubmitDisabled()"><img src="img/search.png" style="width:24px;height:24px;"> Hledat</button>

	  		</form>	

	  		<a class="btn btn-warning ml-auto" href="/vehicles/new"><img src="img/add.png" style="width:24px;height:24px;"> Přidat nové vozidlo</a>

	  		</div>

	  		<transition name="fade">
	  		<table class="table table-hover borderless" style="margin-top: 50px;" v-if="isTableVisible()">

		      <thead>
		        <tr>
		        	<th v-if="isSelectedBus()">Typ</th>
		         	<th>Výrobce</th>
		         	<th>Model</th>
		         	<th v-if="!isSelectedTram()">SPZ</th>
		         	<th v-if="!isSelectedTram()">Spotřeba (l/100km)</th>
		         	<th v-if="isSelectedBus() || isSelectedPersonal()">Počet sedadel</th>
		         	<th v-if="isSelectedTruck()">Maximální nosnost</th>
		         	<th style="width:1%;"></th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="vehicle in fetchedVehicles">
		      		<td v-if="isSelectedBus()">@{{ vehicle.typeOfBus }}</td>
		      		<td>@{{ vehicle.maker }}</td>
		      		<td>@{{ vehicle.model }}</td>
		      		<td v-if="!isSelectedTram()">@{{ vehicle.plateNumber }}</td>
		      		<td v-if="!isSelectedTram()">@{{ vehicle.litresPerKilometer }}</td>
		      		<td v-if="isSelectedBus() || isSelectedPersonal()">@{{ vehicle.seats }}</td>
		      		<td v-if="isSelectedTruck()">@{{ vehicle.maxLoadKilos }}</td>
		      		<td><a class="btn btn-info" v-bind:href="'/vehicles/' + vehicle.VID"><img src="img/pencil.png" style="width:24px;height:24px;"> Detail</a></td>
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
		var fetchedBranches = {!! $fdepots !!};
	</script>
	<script src="/js/vehicles/index.js"></script>
@endsection