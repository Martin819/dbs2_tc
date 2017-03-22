@extends('layouts.master')

@section('title')
  Jízdní řády
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Jízdní řády</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container" id="timetables_index">
			<transition name="fade">
	  		<table class="table table-hover borderless">

		      <thead>
		        <tr>
		        	<th>Číslo linky:</th>
		         	<th></th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="busline in buslines">
		      		<td v-text="busline.lineNr"></td>
		      		<td>Detail</td>
		      	</tr>
		      </tbody>

		    </table>
		    </transition>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var buslines = {!! $buslines !!}
	</script>
	<script src="/js/timetables/index.js"></script>
@endsection