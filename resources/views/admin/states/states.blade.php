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
            <div class="card-header text-center">
                <h1>Add States</h1>

            </div>
            <div class="card py-5">
                <form action="{{route('new-state')}}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">State name</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="state_name" placeholder="">
                                    @error('state_name')
                                    <span class="c-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Country beloing</label>
                                    <select name="country_name" id="" class="form-control">
                                        @isset($countries)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>

                                            @endforeach
                                            @endisset
                                    </select>
                                    @error('country_name')
                                    <span class="c-danger">{{$message}}</span>
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
                <div class="card-header">States</div>

                <div class="card-body">
                    <div class="row">
                        @isset($states)
              @foreach($states as $state)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                          <span class="buttonSpan">

                          <button  type="submit" ><a href="" id_state="{{$state->id}}" stateName="{{$state->name}}" class="delete-state"><i class="fas fa-times delete"></i></a></button>
                          <button type="submit" class="edit"><a href="" edit_id_state="{{$state->id}}" edit_stateName="{{$state->name}}" edit_stateCountry="{{$state->country_id}}"
                                                                class="edit-state"><i class="fas fa-pen-square edit"></i></a></button>
                          </span>
                          <p>{{$state->name}}</p>
                          <p>Country:{{$state->country->name}}</p>


                      </div>
                  </div>
                            @endforeach
                            <div class="col-md-12">
                                @if (!Request::is('*search*'))

                                    {{$states->links()}}

                                @endif
                            </div>
                        @endisset
                        <form action="{{route('search-state')}}" method="get" class="row">
                            @csrf

                            <div class="col-md-2">
                                <label for=""> Search:</label>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" value="{{old('state_search')}}" type="text" name="state_search"  id="state_search">
                                @error('state_search')

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
        <form action="{{route('update-state')}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id"  id="edit_state_id">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit state</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_tag_name">State Name</label>
                                    <input type="text" name="edit_state_name" id="edit_state_name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Country beloing</label>
                                    <select name="edit_state_country" id="edit_state_country" class="form-control">
                                        @isset($countries)
                                            @foreach($countries as $country)
                                                <option @isset($state) @if($country->id==$state->country_id) selected @endif @endisset value="{{$country->id}}">{{$country->name}}</option>

                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('country_name')
                                    <span class="c-danger">{{$message}}</span>
                                    @enderror
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
                    <h5 class="modal-title">Delete State</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="messageUnit"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{route('delete-state')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="state_id" id="state_id" >
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

            var $deleteState =$('.delete-state');
            var $deleteWindow=$('.delete-window');
            var $editState =$('.edit-state');
            var $editWindow=$('.edit-window');
            $deleteState.on('click',function (element){
                element.preventDefault();
                $deleteWindow.modal('show');
                var id_state= $(this).attr('id_state');
                var $state_id=$('#state_id');
                $state_id.val(id_state);
                var state_name=$(this).attr('stateName');
                var message=$('.messageUnit');
                var mess="Are you sure delete "+state_name+" state?"
                message.text(mess);


            });
            $editState.on('click',function (element) {
                element.preventDefault();
                $editWindow.modal('show');
                var edit_state_name=$(this).attr('edit_stateName');
                var edit_state_id=$(this).attr('edit_id_state');
                var edit_state_country=$(this).attr('edit_stateCountry');
                var $edit_state_name=$('#edit_state_name');
                var $edit_state_id=$('#edit_state_id');
                var $edit_state_country=$('#edit_state_country');
                $edit_state_name.val(edit_state_name);
                $edit_state_id.val(edit_state_id);
                $edit_state_country.val(edit_state_country);

            });


            var $back=$('#back');
            $back.on('click',function (element){
                element.preventDefault();
                window.location.href = "{{route('states')}}"
            });

        });
    </script>

@stop
