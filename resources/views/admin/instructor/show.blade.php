@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{$instructor->user->name}}</h3>
          </div>
          <div class="panel-body">
              
            <table class="table table-striped">
              <tr>
                <th>Edycja</th>
              </tr>

                <tr>
                  <td>
                    @include('admin.instructor._options', [$instructor])
                  </td>
                </tr>
                

            </table>

            
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Jazdy</h3>
          </div>
          <div class="panel-body">
            @include('admin.instructor.drives._drives', [$instructor]) 
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Płatności</h3>
          </div>
          <div class="panel-body" id="">
            @include('admin.instructor.drives._formAddHour') 
          </div>
        </div>
      </div>
    </div>
  </div>

@stop