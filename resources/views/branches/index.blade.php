@extends('layouts.master')

@section('title')
  Pobocky
@endsection

@section('content')
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Pobocky</h1>
    </div>
  </div>

  <div class="jumbotron content_container">
    <div class="container" id="search_branches">

      <div class="row" style="margin-left: 0px; margin-right: 0px;">

      <form class="form-inline" method="POST" action="/branches" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        
        <select class="form-control mb-2 mr-sm-2 mb-sm-0" v-model="typeOfBranches">
          <option v-for="type in branchesType" v-bind:value="type.value" :disabled="type.isDisabled">
            @{{ type.text }}
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

        <a class="btn btn-warning ml-auto" href="/branche/new"><img src="img/add.png" style="width:24px;height:24px;"> Přidat novou pobocku</a>

        </div>

        <transition name="fade" v-if="isTableVisible()">
        <table class="table table-hover borderless" style="margin-top: 30px;">
          <thead><th>Adresa</th></thead>
          <tbody>
            <tr v-for="branch in fetchedBranches">
              <td v-text="branch.streetName + ' ' + branch.houseNr"></td>
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
  <script src="/js/branches/index.js"></script>
@endsection