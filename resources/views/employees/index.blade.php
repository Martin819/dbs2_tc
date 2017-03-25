@extends('layouts.master')

@section('title')
  Zamestnanci
@endsection

@section('content')
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Zamestnanci</h1>
    </div>
  </div>

  <div class="jumbotron content_container">
    <div class="container" id="search_vehicle">

      <div class="row" style="margin-left: 0px; margin-right: 0px;">

        <a class="btn btn-warning ml-auto" href="/employees/new"><img src="img/add.png" style="width:24px;height:24px;"> Přidat nového zamestnance</a>

        </div>
        <table class="table table-hover borderless" style="margin-top: 50px;" v-if="isTableVisible()">

          <thead>
            <tr>
              <th>Jmeno</th>
              <th>Prijmeni</th>
              <th>Pozice</th>
              <th>Datum nastupu</th>
              <th style="width:1%;"></th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="employee in fetchedEmployees">
              <td>@{{ employee.firstName }}</td>
              <td>@{{ employee.lastName }}</td>
              <td>@{{ employee.position }}</td>
              <td>@{{ employee.dateHired }}</td>
              <td><a class="btn btn-info" v-bind:href="'/employees/' + employee.EID"><img src="img/pencil.png" style="width:24px;height:24px;"> Detail</a></td>
            </tr>
          </tbody>

        </table>
      </div>
  </div>
@endsection

@section('scripts')
  <script src="/js/employees/index.js"></script>
@endsection 