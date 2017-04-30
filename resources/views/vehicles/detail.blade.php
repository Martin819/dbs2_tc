@extends('layouts.master')

@section('title')
  Detail vozidla
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Detail vozidla</h1>
	  </div>
	</div>

	<div class="jumbotron content_container" id="vehicle_detail">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<img id="obraz">
				</div>
			</div>



			<form method="POST" action="/vehicles/edit" @submit.prevent="onSubmit">
				<div class="row">
							
					<div v-bind:class="[ isBus() ? 'col-md-6' : 'col-md-12' ]">
						<div class="form-group">
				  			<label for="vehicleType">Typ vozidla:</label>
							<select class="form-control" v-model="form.typeOfVehicle" disabled="true">
							  <option v-for="type in vehicleTypes" v-bind:value="type.value" :disabled="type.isDisabled">
							    @{{ type.text }}
							  </option>
							</select>
					 	</div>
					</div>

					<div class="col-md-6" v-if="isBus()">
						<div class="form-group">
				  			<label for="typeOfBus">Typ autobusu:</label>
							<select class="form-control" v-model="form.typeOfBus" disabled="true">
							  <option v-for="type in busTypes" v-bind:value="type" :disabled="type.isDisabled">
							    @{{ type }}
							  </option>
							</select>
					 	</div>
					</div>

				</div>

				<div class="row">

					<div class="col-md-12">
						<div class="form-group">
				  			<label for="homeBranchID">Pobočka:</label>
							<select class="form-control" v-model="form.homeBranchID">
							  <option v-for="branch in branches" v-bind:value="branch.BID">
							    @{{ branch.BID }}
							  </option>
							</select>
					 	</div>
					</div>

				</div>

				<div class="row">
					
					<div v-bind:class="[ !isTram() ? 'col-md-4' : 'col-md-6' ]">
						<div class="form-group">
				  			<label for="maker">Výrobce:</label>
						    <input type="text" class="form-control" id="maker" name="maker" v-model="form.maker">
					 	</div>
					</div>

					<div v-bind:class="[ !isTram() ? 'col-md-4' : 'col-md-6' ]">
						<div class="form-group">
				  			<label for="model">Model:</label>
						    <input type="text" class="form-control" id="model" name="model" v-model="form.model">
					 	</div>
					</div>

					<div class="col-md-4" v-if="!isTram()">
						<div class="form-group">
				  			<label for="plateNumber">SPZ:</label>
						    <input type="text" class="form-control" id="plateNumber" name="plateNumber" v-model="form.plateNumber">
					 	</div>
					</div>

				</div>

				<div class="row">

					<div class="col-md-6">
						<div class="form-group">
				  			<label for="litresPerKilometer">Spotřeba (l/100km):</label>
						    <input type="text" class="form-control" id="litresPerKilometer" name="litresPerKilometer" v-model="form.litresPerKilometer">
					 	</div>
					</div>

					<div class="col-md-6" v-if="!isTruck()">
						<div class="form-group">
				  			<label for="seats">Počet míst:</label>
						    <input type="text" class="form-control" id="seats" name="seats" v-model="form.seats">
					 	</div>
					</div>

					<div class="col-md-6" v-if="isTruck()">
						<div class="form-maxLoadKilos">
				  			<label for="plateNumber">Maximální náklad (kg):</label>
						    <input type="text" class="form-control" id="maxLoadKilos" name="maxLoadKilos" v-model="form.maxLoadKilos">
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
					<a class="btn btn-danger ml-auto" href="#" v-on:click="del()"><img src="../img/delete.png" style="width:24px;height:24px;"> Smazat</a>
				</div>
			</form>	
			</br></br>
			<div class="row" style="margin-bottom: 30px;">
				<div class="col-md-12">
					<form method="POST" enctype="multipart/form-data" @submit.prevent="onUpload">
						{{ csrf_field() }}
						<label for="busimage">Nahrát obrázek:</label></br>
						<input type="file" name="busimage" id="busimage"></input>
						<button type="submit" class="btn btn-primary">Nahrát</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Registr jízd</h2>
	  </div>
	</div>

	<div class="jumbotron content_container" id="vehicle_journeylog">
		<div class="container">
			<table class="table table-hover borderless" v-if="journeylog.length > 0">

		      <thead>
		        <tr>
		        	<th>Začátek události:</th>
		        	<th>Konec události:</th>
		        	<th>Zaměstnanec:</th>
		        	<th>Celkem hodin:</th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="log in selectedlogs">
		      		<td v-text="log.start"></td>
		      		<td v-text="log.end"></td>
		      		<td v-text="log.employee"></td>
		      		<td v-text="log.hours"></td>
		      	</tr>
		      </tbody>

		    </table>

		    <label v-if="journeylog.length < 1" style="color: #BBBBBB">Pro toto vozidlo neexistují žádné záznamy.</label>

		    <div class="row" v-if="journeylog.length > 0">
		    	<div class="col-md-9">
		    		<label v-text="'Zobrazeny záznamy od: '+from+' do: '+selectionEnd" style="color: #BBBBBB"></label>
		    	</div>
		    	
		    	<div class="col-xl-3">
		    		<button class="btn btn-primary ml-auto" :disabled="from <= 0" @click="previous">Předchozí</button>
		    		<button class="btn btn-primary ml-auto" :disabled="to >= journeylog.length" @click="next">Následující</button>
		    	</div>
		    </div>
		</div>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		var vehicle = {!! $vehicle !!};
		var type = {!! $type !!};
		var journeylog = {!! $journeylog !!};
		var branches = {!! $branches !!};
		
	</script>
	<script src="/js/vehicles/detail.js"></script>
	<link href="/css/vehicle_detail.css" rel="stylesheet">
@endsection