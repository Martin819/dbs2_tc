@extends('layouts.master')

@section('title')
  Login
@endsection

@section('content')
  <div class="jumbotron">
  	<div class="container">
	    <label class="display-4">Přihlášení</label>
	</div>
  </div>

  <div class="jumbotron content_container">
  	<div class="login_container mx-auto">
	  	<form>
		  <div class="form-group">
		    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Email">
		  </div>
		  <div class="form-group">
		    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Heslo">
		  </div>
		  <button type="submit" class="btn btn-primary mx-auto d-block">Přihlásit se</button>
		</form>
  	</div>
  </div>

@endsection