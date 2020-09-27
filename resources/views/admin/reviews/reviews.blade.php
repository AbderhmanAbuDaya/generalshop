@extends('layouts.app');

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Reviews</div>

                <div class="card-body">
                    <div class="row">
              @foreach($reviews as $review)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                          <p>{{$review->review}}</p>
                          <p>Stars: @if($review->stars>0)
                                  @for($i=0;$i<$review->stars;++$i)
                                      <i class="fas fa-star"></i>
                                  @endfor
                                       @for($i=$review->stars;$i<5;++$i)
                                                <i class="far fa-star"></i>
                                            @endfor
                              @endif
                          </p>
                          <p>User:{{$review->customer->name}}</p>
                          @if(!empty($review->product))
                          <p>Product:{{$review->product->title}}</p>
                          @endif
                          <p>Date:{{$review->date}}</p>
                      </div>
                  </div>
                    @endforeach
                        <div class="col-md-12">
                            {{$reviews->links()}}
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
    </div>
@stop
