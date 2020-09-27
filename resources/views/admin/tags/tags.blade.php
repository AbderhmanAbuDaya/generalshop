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
            <h1>Add Tag</h1>

        </div>
        <div class="card py-5">
            <form action="{{route('new-tags')}}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tag name</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" name="tag_name" placeholder="">
                                @error('tag_name')
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
                <div class="card-header">Tags</div>

                <div class="card-body">
                    <div class="row">
                        @isset($tags)
              @foreach($tags as $tag)
                  <div class="col-md-3">

                      <div class="alert alert-primary" role="alert">
                           <span class="buttonSpan">

                          <button  type="submit" ><a href="" id_tag="{{$tag->id}}" tagName="{{$tag->tag}}" class="delete-tag"><i class="fas fa-times delete"></i></a></button>
                          <button type="submit" class="edit"><a href="" edit_id_tag="{{$tag->id}}" edit_tagName="{{$tag->tag}}"
                                                                class="edit-tag"><i class="fas fa-pen-square edit"></i></a></button>
                          </span>
                          <p> {{$tag->tag}}</p>

                      </div>
                  </div>
                    @endforeach
                  <div class="col-md-12">
                  @if (!Request::is('*search*'))

                          {{$tags->links()}}

                  @endif
                  </div>
                        @endisset
                  <form action="{{route('search-tag')}}" method="get" class="row">
                      @csrf

                      <div class="col-md-2">
                          <label for=""> Search:</label>
                      </div>
                      <div class="col-md-5">
                          <input class="form-control" value="{{old('tag_search')}}" type="text" name="tag_search"  id="tag_search">
                          @error('tag_search')

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
        <form action="{{route('update-tag')}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id"  id="edit_tag_id">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_tag_name">Tag Name</label>
                                    <input type="text" name="edit_tag_name" id="edit_tag_name" >
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
                    <h5 class="modal-title">Delete Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="messageUnit"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{route('delete-tag')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="tag_id" id="tag_id" >
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

            var $deleteTag =$('.delete-tag');
            var $deleteWindow=$('.delete-window');
            var $editTag =$('.edit-tag');
            var $editWindow=$('.edit-window');
            $deleteTag.on('click',function (element){
                element.preventDefault();
                $deleteWindow.modal('show');
                var id_tag= $(this).attr('id_tag');
                var $tag_id=$('#tag_id');
                $tag_id.val(id_tag);
                var tag_name=$(this).attr('tagName');
                var message=$('.messageUnit');
                var mess="Are you sure delete "+tag_name+" tag?"
                message.text(mess);


            });
            $editTag.on('click',function (element) {
                element.preventDefault();
                $editWindow.modal('show');
                var edit_tag_name=$(this).attr('edit_tagName');
                var edit_tag_id=$(this).attr('edit_id_tag');
                var $edit_tag_name=$('#edit_tag_name');
                var $edit_tag_id=$('#edit_tag_id');
                $edit_tag_name.val(edit_tag_name);
                $edit_tag_id.val(edit_tag_id);

            });


            var $back=$('#back');
            $back.on('click',function (element){
                element.preventDefault();
                window.location.href = "{{route('tags')}}"
            });

        });
    </script>

@stop
