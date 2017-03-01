@extends('layouts.master')

@section('title')
  Registration
@endsection

@section('content')
  <div class="jumbotron">
  	<div class="container">
	    <label class="display-3">Nový uživatel</label>
	</div>
  </div>

  <div class="jumbotron content_container">
	<div class="login_container">
		<form method="POST" action="/register">
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
		 		<button type="submit" class="btn btn-primary">Registrovat</button>
		 	</div>
		 	<div class="form-group">
		 		@include('layouts.errors')
		 	</div>
	  	</form>
	</div>
  </div>

@endsection