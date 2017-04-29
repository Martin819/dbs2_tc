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
			<form method="POST" action="/busimages" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="file" name="busimage"></input>

			<button type="submit">Nahrát</button>
				
			</form>
		</div>
	</div>
@endsection