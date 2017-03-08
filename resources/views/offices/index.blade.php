@extends('layouts.master')

@section('title')
  Pobočky
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Pobočky</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container">
	  	<table class="table table-hover borderless" id="offices_table">
	      <thead>
	        <tr>
	          <th>Název</th>
	          <th>Adresa</th>
	          <th>Manažer</th>
	          <th style="width:1%;"></th>
	        </tr>
	      </thead>
	      <tbody>
	      </tbody>
	    </table>
	    </div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#offices_table').hide();
			$.get('/api/offices', function(offices){ 
				$.each(offices, function(index, value) {
					$('#offices_table > tbody:last-child')
						.append('<tr><td>'+value.name+'</td><td>'+value.address+'</td><td>'+value.manager+'</td><td><a class="btn btn-info" href="/offices/'+value.id+'">Detail</a></td></tr>');
				});
				$('#offices_table').fadeIn();
			});
		});
	</script>
@endsection