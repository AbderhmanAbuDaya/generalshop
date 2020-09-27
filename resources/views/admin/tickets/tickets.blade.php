@extends('layouts.app');

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Tickets</div>

                <div class="card-body">
                    <div class="row">
              @foreach($tickets as $ticket)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                          <h3>{{$ticket->title}}</h3>
                          <p>Message:{{$ticket->message}}</p>
                          <p>state:{{$ticket->status}}</p>
                          @if($ticket->customer!=null)
                          <p>User:{{$ticket->customer->name}}</p>
                          @endif
                          @if($ticket->order!=null)
                              <p>User:{{$ticket->order->cart->cartItem->product}}</p>
                          @endif
                      </div>
                  </div>
                    @endforeach
                        <div class="col-md-12">
                            {{$tickets->links()}}
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
    </div>
@stop
