@extends('layouts.master')

@section('title')
  Pobočky
@endsection

@section('content')
<div id="branches">
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Kanceláře</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container">
			<table class="table table-hover borderless">
				<thead>
					<th>Název</th>
					<th>Adresa</th>
					<th style="width:1%;"></th>
				</thead>
				<tbody>
					<tr v-for="office in offices">
						<td v-text="office.name"></td>
						<td v-text="getAddressFor(office)"></td>
						<td><a class="btn btn-info" v-bind:href="'/branches/' + office.BID"> Detail</a></td>
					</tr>
				</tbody>
			</table>	
	    </div>
	</div>

	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Depa</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container">
			<table class="table table-hover borderless">
				<thead>
					<th>Adresa</th>
					<th style="width:1%;"></th>
				</thead>
				<tbody>
					<tr v-for="depot in depots">
						<td v-text="getAddressFor(depot)"></td>
						<td><a class="btn btn-info" v-bind:href="'/branches/' + depot.BID"> Detail</a></td>
					</tr>
				</tbody>
			</table>	
	    </div>
	</div>

	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Skladiště</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container">
			<table class="table table-hover borderless">
				<thead>
					<th>Adresa</th>
					<th style="width:1%;"></th>
				</thead>
				<tbody>
					<tr v-for="warehouse in warehouses">
						<td v-text="getAddressFor(warehouse)"></td>
						<td><a class="btn btn-info" v-bind:href="'/branches/' + warehouse.BID"> Detail</a></td>
					</tr>
				</tbody>
			</table>	
	    </div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var depots = {!! $depots !!};
		var offices = {!! $offices !!};
		var warehouses = {!! $warehouses !!};
	</script>
	<script src="/js/branches/index.js"></script>
@endsection