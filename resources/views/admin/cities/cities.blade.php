@extends('layouts.app');

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Cities</div>

                <div class="card-body">
                    <div class="row">
              @foreach($cities as $city)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                          <p>{{$city->name}}</p>
                          <p>Country:{{$city->country->name}}</p>
                          <p>state:{{$city->state->name}}</p>
                          <p>state_code:{{$city->state_code}}</p>

                      </div>
                  </div>
                    @endforeach
                        <div class="col-md-12">
                            {{$cities->links()}}
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
    </div>
@stop
