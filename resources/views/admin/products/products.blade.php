@extends('layouts.app');

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="toast my-2" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 9999; margin:auto">
                <div class="toast-header">
                    <img src="..." class="rounded mr-2" alt="...">
                    <strong class="mr-auto">Bootstrap</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{Session::get('success')}}
                </div>
            </div>
        @endif
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">Products</div>
                <div class="card-header"><a class="btn btn-success" href="{{route('new-product')}}"> New product</a></div>

                <div class="card-body">
                    <div class="row">
              @foreach($products as $product)
                  <div class="col-md-6 w-75">

                      <div class="alert alert-primary" role="alert">
                          <h3 class="text-center">{{$product->title}}</h3>
                          <p>Category:{{$product->category->name}}</p>
                          <p>{{$product->description}}</p>
                          Price:<span class="alert-danger">{{$product->price}} {{$currencyCode}}</span>
                          @if(($product->images->count())>0)
{{--                                    @if($product->images[0]->url)--}}
                          {{strstr($product->images[0]->url,'/',true)}}
                          @if(strstr($product->images[0]->url,'/',true)=='https:')
                          <img src="{{$product->images[0]->url}}" alt="" class="img-thumbnail card-img">
                              @else
                                  <img src="{{asset('product/images/'.$product->images[0]->url)}}" alt="" class="img-thumbnail card-img">

                              @endif
                              @endif
                          <a class="btn btn-success" href="{{route('edit-product',$product->id)}}"> Edit product</a>

                      </div>

                  </div>

                        @endforeach
                        <div class="col-md-12">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
    </div>
@stop

@section('script')
    @if(Session::has('success'))
        <script>

            jQuery(document).ready(function ($){
                var $toast=$('.toast').toast({

                    autohide:false
                });
                $toast.toast('show');
            });

        </script>
    @endif
    @stop
