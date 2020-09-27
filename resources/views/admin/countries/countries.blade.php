@extends('layouts.app');

@section('content')
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

    <div class="container">
        <div class="card-header text-center">
            <h1>Add Country</h1>

        </div>
        <div class="card py-5">
            <form action="{{route('new-country')}}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Country name</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" name="country_name" placeholder="">
                                @error('country_name')
                                <span class="c-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Phone code</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="phone_code" placeholder="">
                                @error('phone_code')
                                <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Currency</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="currency" placeholder="">
                                @error('currency')
                                <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Capital</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="capital" placeholder="">
                                @error('capital')
                                <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <input type="submit"  class="btn btn-success" value="Add">
                    </div>
                </div>

            </form>
        </div>
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Countries</div>

                <div class="card-body">
                    <div class="row">
                        @isset($countries)

                        @foreach($countries as $country)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                             <span class="buttonSpan">

                          <button  type="submit" ><a href="" id_country="{{$country->id}}" countryName="{{$country->name}}" class="delete-country"><i class="fas fa-times delete"></i></a></button>
                          <button type="submit" class="edit"><a href="" edit_id_country="{{$country->id}}" edit_countryName="{{$country->name}}"  edit_phoneCode="{{$country->phonecode}}"  edit_capital="{{$country->capital}}"  edit_currency="{{$country->currency}} "
                                                                class="edit-country"><i class="fas fa-pen-square edit"></i></a></button>
                          </span>
                          <p>{{$country->name}}</p>
                          <p>Currency:{{$country->currency}}</p>
                          <p>Capital:{{$country->capital}}</p>

                      </div>
                  </div>
                    @endforeach
                        <div class="col-md-12">
                            @if (!Request::is('*search*'))

                                {{$countries->links()}}
                                @endif
                        </div>
                        @endisset
                            <form action="{{route('search-country')}}" method="get" class="row">
                                @csrf

                                <div class="col-md-2">
                                    <label for=""> Search:</label>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" value="{{old('country_search')}}" type="text" name="country_search"  id="country_search">
                                    @error('country_search')

                                    <span>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <button class="btn btn-outline-success" name="search" type="submit">Search</button>

                                    @if (Request::is('*search*'))
                                        <button class="btn btn-outline-danger" id="back" name="search" type="submit">back </button>

                                    @endif

                                </div>




                            </form>

                    </div>
                </div>
            </div>


        </div>



    </div>
    </div>


    {{--        Model edit          --}}
    <div class="modal edit-window" tabindex="-1" role="dialog">
        <form action="{{route('update-country')}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id"  id="edit_country_id">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Country</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_unit_name">Country Name</label>
                                    <input type="text" name="edit_country_name" id="edit_country_name" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_unit_code">Phone code</label>
                                    <input type="text" name="edit_phone_code" id="edit_phone_code" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block" for="edit_capital">Capital</label>
                                    <input type="text" name="edit_capital" id="edit_capital" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_unit_code">Currency</label>
                                    <input type="text" name="edit_currency" id="edit_currency" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    {{--        Model delete          --}}
    <div class="modal delete-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="messageUnit"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{route('delete-country')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="country_id" id="country_id" >
                        <button type="submit" class="btn btn-primary">Delete</button>

                    </form>
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


    <script>
        $(document).ready(function (){

            var $deleteCountry =$('.delete-country');
            var $deleteWindow=$('.delete-window');
            var $editCountry =$('.edit-country');
            var $editWindow=$('.edit-window');
            $deleteCountry.on('click',function (element){
                element.preventDefault();
                $deleteWindow.modal('show');
                var id_country= $(this).attr('id_country');
                var $country_id=$('#country_id');
                $country_id.val(id_country);
                var country_name=$(this).attr('countryName');
                var message=$('.messageUnit');
                var mess="Are you sure delete "+country_name+" Country?"
                message.text(mess);


            });
            $editCountry.on('click',function (element) {
                element.preventDefault();
                $editWindow.modal('show');
                var edit_country_name=$(this).attr('edit_countryName');
                var edit_phone_code=$(this).attr('edit_phoneCode');
                var edit_capital=$(this).attr('edit_capital');
                var edit_currency=$(this).attr('edit_currency');
                var edit_country_id=$(this).attr('edit_id_country');
                var $edit_country_name=$('#edit_country_name');
                var $edit_phone_code=$('#edit_phone_code');
                var $edit_currency=$('#edit_currency');
                var $edit_capital=$('#edit_capital');
                var $edit_country_id=$('#edit_country_id');
                $edit_country_name.val(edit_country_name);
                $edit_phone_code.val(edit_phone_code);
                $edit_currency.val(edit_currency);
                $edit_capital.val(edit_capital);
                $edit_phone_code.val(edit_phone_code);
                $edit_country_id.val(edit_country_id);


            });


            var $back=$('#back');
            $back.on('click',function (element){
                element.preventDefault();
                window.location.href = "{{route('countries')}}"
            });

        });
    </script>

@stop
