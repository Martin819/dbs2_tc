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
	  	<table class="table table-hover borderless">
	      <thead>
	        <tr>
	          <th>Název</th>
	          <th>Adresa</th>
	          <th>Manažer</th>
	        </tr>
	      </thead>
	      <tbody>
	      	@foreach ($offices as $office)
		        <tr>
		          <th scope="row">{{ $office->name }}</th>
		          <td>{{ $office->address }}</td>
		          <td>{{ $office->manager }}</td>
		        </tr>
	        @endforeach
	      </tbody>
	    </table>
	    </div>
	</div>
@endsection