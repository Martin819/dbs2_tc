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
		    <div class="d-flex justify-content-start" v-for="busline in buslines">
			  <div class="p-2">Linka <strong>@{{busline.lineNr}}</strong></div>
			  <div class="ml-auto p-2">
			  	<a class="btn btn-info" v-bind:href="'/timetables/' + busline.LID"><img src="img/pencil.png" style="width:24px;height:24px;"> Detail</a>
			  </div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var buslines = {!! $buslines !!}
	</script>
	<script src="/js/timetables/index.js"></script>
@endsection