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
			<table class="table table-hover borderless">
				<thead>
					<th>Linka</th>
					<th style="width:1%;"></th>
				</thead>
				<tbody>
					<tr v-for="busline in buslines">
						<td v-text="busline.lineNr"></td>
						<td><a class="btn btn-info" v-bind:href="'/timetables/' + busline.LID"><img src="img/pencil.png" style="width:24px;height:24px;"> Detail</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var buslines = {!! $buslines !!}
	</script>
	<script src="/js/timetables/index.js"></script>
@endsection