@extends('layouts.master')

@section('title')
  Nove heslo
@endsection

@section('content')
  <div class="jumbotron">
  	<div class="container">
	    <label class="display-3">Uzivatel</label>
	</div>
  </div>

  <div class="jumbotron content_container">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<form method="POST" action="/pass">
			  		{{ csrf_field() }}
			  		<div class="form-group">
			  			<label for="name">Jméno:</label>
					    <input type="text" class="form-control" id="name" name="name" required>
				 	</div>
				 	<div class="form-group">
			  			<label for="email">Email:</label>
					    <input type="email" class="form-control" id="email" name="email" required>
				 	</div>
				 	<div class="form-group">
			  			<label for="password">Heslo:</label>
					    <input type="password" class="form-control" id="password" name="password" required>
				 	</div>
				 	<div class="form-group">
			  			<label for="password_confirmation">Heslo znovu:</label>
					    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
				 	</div>
				 	<div class="form-group">
				 		<button type="submit" class="btn btn-primary">Ulozit</button>
				 	</div>
				 	<div class="form-group">
				 		@include('layouts.errors')
				 	</div>
			  	</form>
			</div>
		</div>
	</div>
  </div>

@endsection