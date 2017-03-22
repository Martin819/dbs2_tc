@extends('layouts.master')

@section('title')
  Detail zákazníka
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Detail zákazníka</h1>
	  </div>
	</div>

	<div class="jumbotron content_container" id="customer_detail">
		<div class="container">
			<form method="POST" action="/customers/edit" @submit.prevent="onSubmit">
				<div class="row">
							
					<div class="col-md-4">
						<div class="form-group">
				  			<label for="vehicleType">Typ zákazníka:</label>
							<select class="form-control" v-model="form.typeOfCustomer" disabled="true">
							  <option v-for="type in typesOfCustomers" v-bind:value="type.text" :disabled="type.isDisabled">
							    @{{ type.text }}
							  </option>
							</select>
					 	</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
				  			<label for="firstname">Jméno:</label>
						    <input type="text" class="form-control" id="firstname" name="firstname" v-model="form.firstname">
					 	</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
				  			<label for="lastname">Příjmení:</label>
						    <input type="text" class="form-control" id="lastname" name="lastname" v-model="form.lastname">
					 	</div>
					</div>

				</div>

			</form>	
		</div>
	</div>

	<div class="jumbotron">
	  <div class="container">
	    <h2 class="display-3">Zakázky</h2>
	  </div>
	</div>

	<div class="jumbotron content_container" id="customer_invoices">
		<div class="container">
			<table class="table table-hover borderless">

		      <thead>
		        <tr>
		        	<th>Začátek události:</th>
		        	<th>Konec události:</th>
		        	<th>Zaměstnanec:</th>
		        	<th>Celkem hodin:</th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr>
		      		<td>Ahoj</td>
		      		<td>Ahoj</td>
		      		<td>Ahoj</td>
		      		<td>Ahoj</td>
		      	</tr>
		      </tbody>

		    </table>
		</div>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		var companyName = {!! $companyName !!};
		var customer = {!! $customer !!};
	</script>
	<script src="/js/customers/detail.js"></script>
@endsection