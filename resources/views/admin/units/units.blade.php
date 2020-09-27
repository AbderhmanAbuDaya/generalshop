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
               <h1>Add unit</h1>

           </div>
      <div class="card py-5">
        <form action="{{route('new-unit')}}" method="POST">
            @csrf
            <div class="container">
            <div class="row">

                <div class="col-md-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Unit name</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="unit_name" placeholder="">
                @error('unit_name')
                <span class="c-danger">{{$message}}</span>
                @enderror
            </div>
                </div>
                <div class="col-md-6">
            <div class="form-group">
                <label for="formGroupExampleInput2">Unit code</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="unit_code" placeholder="">
                @error('unit_code')
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
                <div class="card-header">Units</div>

                <div class="card-body">
                    <div class="row">
                        @isset($units)
              @foreach($units as $unit)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                          <span class="buttonSpan">

                          <button  type="submit" ><a href="" id_unit="{{$unit->id}}" unitName="{{$unit->unit_name}}" class="delete-unit"><i class="fas fa-times delete"></i></a></button>
                          <button type="submit" class="edit"><a href="" edit_id_unit="{{$unit->id}}" edit_unitName="{{$unit->unit_name}}"  edit_unitCode="{{$unit->unit_code}}"
                                                                class="edit-unit"><i class="fas fa-pen-square edit"></i></a></button>
                          </span>
                          <p>{{$unit->unit_name}}: {{$unit->unit_code}}</p>

                      </div>
                  </div>
                    @endforeach
                  <div class="col-md-12">
                  @if (!Request::is('*search*'))

                            {{$units->links()}}

                  @endif
                  </div>
                        @endisset
                  <form action="{{route('search-unit')}}" method="get" class="row">
                      @csrf

                                      <div class="col-md-2">
                                          <label for=""> Search:</label>
                                      </div>
                              <div class="col-md-5">
                                          <input class="form-control" value="{{old('unit_search')}}" type="text" name="unit_search"  id="unit_search">
                                  @error('unit_search')

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
        <form action="{{route('update-unit')}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id"  id="edit_unit_id">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Uint</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                     <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_unit_name">Unit Name</label>
                                <input type="text" name="edit_unit_name" id="edit_unit_name" >
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_unit_code">Unit Name</label>
                                <input type="text" name="edit_unit_code" id="edit_unit_code" >
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
                    <h5 class="modal-title">Delete Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="messageUnit"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{route('delete-unit')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="unit_id" id="unit_id" >
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

        var $deleteUnit =$('.delete-unit');
        var $deleteWindow=$('.delete-window');
        var $editUnit =$('.edit-unit');
        var $editWindow=$('.edit-window');
              $deleteUnit.on('click',function (element){
                  element.preventDefault();
                 $deleteWindow.modal('show');
                 var id_unit= $(this).attr('id_unit');
                 var $unit_id=$('#unit_id');
                 $unit_id.val(id_unit);
                 var unit_name=$(this).attr('unitName');
                  var message=$('.messageUnit');
                  var mess="Are you sure delete "+unit_name+" unit?"
                  message.text(mess);


              });
              $editUnit.on('click',function (element) {
                  element.preventDefault();
                  $editWindow.modal('show');
                  var edit_unit_name=$(this).attr('edit_unitName');
                  var edit_unit_code=$(this).attr('edit_unitCode');
                  var edit_unit_id=$(this).attr('edit_id_unit');
                  var $edit_unit_name=$('#edit_unit_name');
                  var $edit_unit_code=$('#edit_unit_code');
                  var $edit_unit_id=$('#edit_unit_id');
                  $edit_unit_name.val(edit_unit_name);
                  $edit_unit_code.val(edit_unit_code);
                  $edit_unit_id.val(edit_unit_id);

              });


              var $back=$('#back');
              $back.on('click',function (element){
                  element.preventDefault();
                  window.location.href = "{{route('units')}}"
              });

          });
    </script>

    @stop
