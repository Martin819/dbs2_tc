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
    <div class="container" id="search_employee">

      <div class="row" style="margin-left: 0px; margin-right: 0px;">

      <form class="form-inline" method="POST" action="/employees" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        
        <select class="form-control mb-2 mr-sm-2 mb-sm-0" v-model="form.selectedPosition">
          <option v-for="position in employeePositions" v-bind:value="position.value" :disabled="position.isDisabled">
            @{{ position.text }}
          </option>
        </select>

<!--         <transition name="fade">
<select class="form-control mb-2 mr-sm-2 mb-sm-0" v-model="form.selectedTypeOfBus" v-if="form.selectedTypeOfVehicle == 1">
  <option v-for="type in busTypes" :disabled="type.isDisabled">
    @{{ type.text }}
  </option>
</select>
</transition> -->

        <button type="submit" class="btn btn-primary mb-2 mr-sm-2 mb-sm-0"><img src="img/search.png" style="width:24px;height:24px;"> Hledat</button>

        </form> 

        <a class="btn btn-warning ml-auto" href="/employees/new"><img src="img/add.png" style="width:24px;height:24px;"> Přidat nového zamestnance</a>

        </div>

        <transition name="fade">
        <table class="table table-hover borderless" style="margin-top: 50px;" v-if="isTableVisible()">

          <thead>
            <tr>
              <th>Cele jmeno</th>
              <th>Pozice</th>
              <th>Datum nastupu</th>
              <th>Pobocka</th>
              <th style="width:1%;"></th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="employee in fetchedEmployees">
              <td>@{{ employee.fullName }}</td>
              <td>@{{ employee.position }}</td>
              <td>@{{ employee.dateHired }}</td>
              <td>@{{ employee.branchAddress }}</td>
              <td><a class="btn btn-info" v-bind:href="'/employees/' + employee.EID"><img src="img/pencil.png" style="width:24px;height:24px;"> Detail</a></td>
            </tr>
          </tbody>

        </table>
        </transition>

        <transition name="fade">
        <div class="row justify-content-center" style="margin-top: 50px;" v-if="isLoading">
          @include('layouts.activity_indicator')
        </div>  
        </transition>   

      </div>
  </div>
@endsection

@section('scripts')
  <script src="/js/employees/index.js"></script>
@endsection