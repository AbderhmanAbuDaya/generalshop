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
            <h1>Add Role</h1>

        </div>
        <div class="card py-5">
            <form action="{{route('new-role')}}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Role name</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" name="role_name" placeholder="">
                                @error('role_name')
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
                <div class="card-header">Roles</div>

                <div class="card-body">
                    <div class="row">
                        @isset($roles)
              @foreach($roles as $role)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                           <span class="buttonSpan">

                          <button  type="submit" ><a href="" id_role="{{$role->id}}" roleName="{{$role->role}}" class="delete-role"><i class="fas fa-times delete"></i></a></button>
                          <button type="submit" class="edit"><a href="" edit_id_role="{{$role->id}}" edit_roleName="{{$role->role}}"
                                                                class="edit-role"><i class="fas fa-pen-square edit"></i></a></button>
                          </span>
                          <h4>{{$role->role}}</h4>

                      </div>
                  </div>
                    @endforeach
                  <div class="col-md-12">
                      @if (!Request::is('*search*'))

                          {{$roles->links()}}

                      @endif
                  </div>
                        @endisset
                            <form action="{{route('search-role')}}" method="get" class="row">
                                @csrf

                                <div class="col-md-2">
                                    <label for=""> Search:</label>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" value="{{old('role_search')}}" type="text" name="role_search"  id="role_search">
                                    @error('role_search')

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
        <form action="{{route('update-role')}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id"  id="edit_role_id">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_role_name">Role Name</label>
                                    <input type="text" name="edit_role_name" id="edit_role_name" >
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
                    <h5 class="modal-title">Delete Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="messageUnit"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{route('delete-role')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="role_id" id="role_id" >
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

            var $deleteRole =$('.delete-role');
            var $deleteWindow=$('.delete-window');
            var $editRole=$('.edit-role');
            var $editWindow=$('.edit-window');
            $deleteRole.on('click',function (element){
                element.preventDefault();
                $deleteWindow.modal('show');
                var id_role= $(this).attr('id_role');
                var $role_id=$('#role_id');
                $role_id.val(id_role);
                var role_name=$(this).attr('roleName');
                var message=$('.messageUnit');
                var mess="Are you sure delete "+role_name+" role?"
                message.text(mess);


            });
            $editRole.on('click',function (element) {
                element.preventDefault();
                $editWindow.modal('show');
                var edit_role_name=$(this).attr('edit_roleName');

                var edit_role_id=$(this).attr('edit_id_role');
                var $edit_role_name=$('#edit_role_name');

                var $edit_role_id=$('#edit_role_id');
                $edit_role_name.val(edit_role_name);

                $edit_role_id.val(edit_role_id);

            });


            var $back=$('#back');
            $back.on('click',function (element){
                element.preventDefault();
                window.location.href = "{{route('roles')}}"
            });

        });
    </script>

@stop
