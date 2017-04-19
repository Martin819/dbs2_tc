@extends('layouts.master')

@section('title')
  Jízdní řády
@endsection

@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1 class="display-3">Jízdní řády - linka @{{ busline.lid }}</h1>
	  </div>
	</div>

	<div class="jumbotron content_container">
		<div class="container" id="timetables_index">
			<transition name="fade">
	  		<table class="table table-hover borderless">

		      <thead>
		        <tr>
		        	<th>Zastávka:</th>
		         	<th>Den:</th>
		         	<th>Čas:</th>
		         	<th>Autobus:</th>
		        </tr>
		      </thead>

		      <tbody>
		      	<tr v-for="timetable in timetables">
		      		<td v-text="timetable.busStopName"></td>
		      		<td v-text="timetable.dayOfWeek"></td>
		      		<td v-text="timetable.timeOfArrival"></td>
		      		<td v-text="timetable.busID"></td>
		      	</tr>
		      </tbody>

		    </table>
		    </transition>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="/js/timetables/index.js"></script>
@endsection