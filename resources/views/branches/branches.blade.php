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
	        <tr>
	          <th scope="row"><a style="color: #292b2c;" href="/">Centrála podniku</a></th>
	          <td>Šeránkova 185, Kladno, 272 01</td>
	          <td>Oskar Hrabal</td>
	        </tr>
	        <tr>
	          <th scope="row">Kancelářský komplex Vltava</th>
	          <td>Výspa 83, Frýdek-Místek, 739 41</td>
	          <td>Alexej Wagner</td>
	        </tr>
	        <tr>
	          <th scope="row">Office park New Age</th>
	          <td>Mojmírovo náměstí 226, Most, 435 02</td>
	          <td>Hubert Úlehla</td>
	        </tr>
	        <tr>
	          <th scope="row">Office park Future</th>
	          <td>Blažkova 87, Žďár nad Sázavou, 591 02</td>
	          <td>Bronislav Stuchlý</td>
	        </tr>
	        <tr>
	          <th scope="row">Kancelářský komplex Dunaj</th>
	          <td>Haškova 191, Prostějov, 796 01</td>
	          <td>Matěj Kaleta</td>
	        </tr>
	      </tbody>
	    </table>
	    </div>
	</div>
@endsection