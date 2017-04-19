@extends('layouts.master')

@section('title')
  Jízdní řády
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Linka {{ $timetable[0]->lineNr }}</h1>
	  </div>
	</div>

	<div class="jumbotron content_container" id="timetables_detail">

		<div class="container daycontainer">
			<h4>Pondělí</h4>
	  		<table class="table table-hover borderless">
		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Příjezdy:</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<tr v-for="busstop in monday">
		      		<td v-text="busstop.name"></td>
		      		<td v-text="busstop.timetable"></td>
		      	</tr>
		      </tbody>
		    </table>
		</div>

		<div class="container daycontainer">
			<h4>Úterý</h4>
	  		<table class="table table-hover borderless">
		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Příjezdy:</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<tr v-for="busstop in tuesday">
		      		<td v-text="busstop.name"></td>
		      		<td v-text="busstop.timetable"></td>
		      	</tr>
		      </tbody>
		    </table>
		</div>

		<div class="container daycontainer">
	  		<h4>Středa</h4>
	  		<table class="table table-hover borderless">
		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Příjezdy:</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<tr v-for="busstop in wednesday">
		      		<td v-text="busstop.name"></td>
		      		<td v-text="busstop.timetable"></td>
		      	</tr>
		      </tbody>
		    </table>
		</div>

		<div class="container daycontainer">
	  		<h4>Čtvrtek</h4>
	  		<table class="table table-hover borderless">
		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Příjezdy:</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<tr v-for="busstop in thursday">
		      		<td v-text="busstop.name"></td>
		      		<td v-text="busstop.timetable"></td>
		      	</tr>
		      </tbody>
		    </table>
		</div>
		
		<div class="container daycontainer">
	  		<h4>Pátek</h4>
	  		<table class="table table-hover borderless">
		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Příjezdy:</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<tr v-for="busstop in friday">
		      		<td v-text="busstop.name"></td>
		      		<td v-text="busstop.timetable"></td>
		      	</tr>
		      </tbody>
		    </table>
		</div>

		<div class="container daycontainer">
	  		<h4>Sobota</h4>
	  		<table class="table table-hover borderless">
		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Příjezdy:</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<tr v-for="busstop in saturday">
		      		<td v-text="busstop.name"></td>
		      		<td v-text="busstop.timetable"></td>
		      	</tr>
		      </tbody>
		    </table>
		</div>
		
		<div class="container daycontainer">
	  		<h4>Neděle</h4>
	  		<table class="table table-hover borderless">
		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Příjezdy:</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<tr v-for="busstop in sunday">
		      		<td v-text="busstop.name"></td>
		      		<td v-text="busstop.timetable"></td>
		      	</tr>
		      </tbody>
		    </table>
		</div>

	</div>
@endsection
	
@section('scripts')
	<link rel="stylesheet" type="text/css" href="/css/timetables/detail.css">

	<script>
		var timetable = {!! $timetable !!};
	</script>
	<script src="/js/timetables/detail.js"></script>
@endsection