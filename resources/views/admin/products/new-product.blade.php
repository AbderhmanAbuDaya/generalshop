@extends('layouts.app')


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
    <div class="container" xmlns="http://www.w3.org/1999/html">
<div class="card">
    <div class="card-header text-center">
    <h1>
        @if(is_null($product))
            New Product

        @else
        Update Product

        @endif
    </h1>
    </div>
    <div class="card-title mt-2 ml-2 ">
        @if(!is_null($product))

            Update <spane class="text-black-50 "> {{$product->title}} </spane>
        @endif
    </div>
    <div class="card-body">
        <form action="{{route('new-product')}}" enctype="multipart/form-data" method="post">
            @csrf
            @if(!is_null($product))
                @method('PUT')
                <input type="hidden"  name="product_id" value="{{$product->id}}" >
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Prodcut title</label>
                        <input type="text" class="form-control" @if(!is_null($product)) value="{{$product->title}}" @endif name="product_title" placeholder="">
                        @error('product_name')
                        <span class="alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Prodcut description</label>
                        <textarea type="" class="form-control"  name="product_description" placeholder="">@if(!is_null($product)) {{$product->description}} @endif
                        </textarea>
                        @error('product_description')
                        <span class="alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Prodcut price</label>
                        <input type="text" class="form-control"  @if(!is_null($product)) value="{{$product->price}}" @endif name="product_price" placeholder="">
                        @error('product_price')
                        <span class="alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Prodcut discount</label>
                        <input type="text" class="form-control" @if(!is_null($product)) value="{{$product->discount}}" @endif name="product_discount" placeholder="">
                        @error('product_discount')
                        <span class="alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Prodcut total</label>
                        <input type="text" class="form-control"  @if(!is_null($product)) value="{{$product->total}}" @endif name="product_total" placeholder="">
                        @error('product_total')
                        <span class="alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Prodcut unit</label>
                        <select name="product_unit" id="product_unit" class="form-control">
                            @isset($units)
                                @foreach($units as $unit)
                                    <option  @if(!is_null($product)&&$product->unit==$unit->id) selected @endif  value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('product_unit')
                        <span class="alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Prodcut Category</label>
                        <select name="product_category" id="product_category" class="form-control">
                            @isset($categories)
                                @foreach($categories as $category)
                                    <option  @if(!is_null($product)&&$product->category_id==$category->id) selected @endif  value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('product_category')
                        <span class="alert-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                 <div class="col-md-12">
                     <table id="option-table" class="table table-striped">
                         @isset($product)
                             @if($product->jsonOptions())
                            @foreach($product->jsonOptions() as $key=>$value)
                         @foreach($value as $optionValue)

                             <tr>
                              <td> {{$key}}</td>
                               <td>{{$optionValue}}
                                   <input type="hidden" name="{{$key}}[]" value="{{$optionValue}}"></td>
                                 <td>                                 <a optionValue="optionValue" href="" class="btn btn-danger" id="removeRow">remove</a>
                                 </td>
                                 <td><input type="hidden" name="options[]" value="{{$key}}"></td>
                                                              </tr>

                             @endforeach
                             @endforeach
                             @endif

                         @endisset


                     </table>
                 </div>
                <div class="col-md-12">
                    <a href="" class="btn btn-outline-primary add-option-btn"> Add option</a>
                </div>
                <div class="col-md-12 my-2">
                    <h1 for="">Images</h1>
                    <div class="row">
                        @for($i=0;$i<6;++$i)
                            <div class="col-md-4 mb-4">
                                    <div class="card image-card-upload" >

                                        @if(isset($product)&&!is_null($product->images)&& $product->images->count()>0)
                                            @if(isset($product->images[$i])&&!is_null($product->images[$i]))
                                                @if(strstr($product->images[$i]->url,'/',true)=='https:')
                                                    <div class="text-right ">   <a href="" class="remove-image-upload text-danger " image_id="{{$product->images[$i]->id}}" fileid="image-{{$i}}"  ><i class="fas fa-minus-circle "></i></a></div>

                                                    <img id="iimage-{{$i}}" src="{{$product->images[0]->url}}" class="card-img-top" alt="...">

                                                @else
                                                    <div class="text-right ">   <a href="" class="remove-image-upload text-danger " image_id="{{$product->images[$i]->id}}" fileid="image-{{$i}}"  ><i class="fas fa-minus-circle "></i></a></div>

                                                    <img id="iimage-{{$i}}"   src="{{asset('product/images/'.$product->images[$i]->url)}}"class="card-img-top" alt="...">

                                                @endif

                                            @endif
                                        @endif

                                        <div class="text-right ">   <a href="" class="remove-image-{{$i}} text-danger d-none " ><i class="fas fa-minus-circle "></i></a></div>

                                        <a href="#" class="activate-image-upload" fileid="image-{{$i}}">
                                            <div class="card-body" >
{{--                                            <div id="showImage" >--}}
                                                <p class="card-text text-center"><i class="fas fa-plus-circle"></i></p>

{{--                                            </div>--}}


                                        </div>

                                        </a>
                                            @if(isset($product)&&!is_null($product->images)&& $product->images->count()>0)
                                                @if(isset($product->images[$i])&&!is_null($product->images[$i]))
                                                    <p class="card-text text-center"><i class="fas fa-plus-circle d-none"></i></p>

                                                @else
                                                    <input type="file" name="product_image[]" class="form-control-file image-file-upload" id="input-image-{{$i}}" >
                                                @endif

                                            @else
                                                <input type="file" name="product_image[]" class="form-control-file image-file-upload" id="input-image-{{$i}}" >

                                            @endif

                                        @if(!isset($product))
                                                <input type="file" name="product_image[]" class="form-control-file image-file-upload" id="input-image-{{$i}}" >

                                            @endif
                                    </div>
                            </div>


                            @endfor
                    </div>
                </div>

                <div class="col-md-12">
                    <div>
                    <button type="submit" class="btn btn-outline-success w-50 d-block  offset-3  "> Submit</button>
                    </div>
                </div>


            </div>
        </form>


    </div>
</div>
    </div>
    {{--        Model Opstion          --}}
    <div class="modal option-window" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Option</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_unit_name">Option Name</label>
                                    <input type="text" name="option_name" id="option_name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_unit_code">Option value</label>
                                    <input type="text" name="option_value" id="option_value" class="form-control" >
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary add-option-button">Save changes</button>
                    </div>
                </div>
            </div>
    </div>


@stop


  @section('script')
      <script>

          $(document).ready(function (){
              var $toast=$('.toast').toast({

                  autohide:false
              });
              $toast.toast('show');

              var $optionWindow=$('.option-window');
              var $addOption=$('.add-option-btn');
              var $optionTable=$('#option-table');
                $addOption.on('click',function (element){
                    element.preventDefault();
                    $optionWindow.modal('show');
                });

                var optionsNameList=[];
              var optionsRow;
                $(document).on('click','.add-option-button',function (e){
                   e.preventDefault();
                   var optionName=$('#option_name').val();
                   if(optionName===""){
                       alert("Option name is required");
                       return false;
                   }
                   var optionValue=$('#option_value').val();
                    if(optionValue===""){
                        alert("Option value is required");
                        return false;
                    }
                    if(!optionsNameList.includes(optionName)){
                        optionsNameList.push(optionName);
                         optionsRow='<input type="hidden" name="options[]"'+'value="'+optionName+'" >';
                        $optionTable.append(optionsRow);


                    }
                    var optionRow='<tr id="remove'+optionValue+'"><td>'+optionName+'</td><td>'+optionValue+'</td><td><a optionValue="'+optionValue+'" href="" class="btn btn-danger" id="removeRow">remove</a><input type="hidden" name="'+optionName+'[]"'+'value="'+optionValue+'" ></td></tr>';

                    $optionTable.append(optionRow);
                    $('#option_value').val('');


                });

                $(document).on('click','#removeRow',function (e) {
                    e.preventDefault();
                    $(this).parent().parent().remove();

                 // var value=$(this).attr('optionValue');
                 //
                 // var id='#remove'+value;
                 //    $(id).remove();
                });


              var $activateImageUpload=$('.activate-image-upload');
              var $imageFileUpload=$('.image-file-upload');
              var $imageCardUpload=$('.image-card-upload');
            $activateImageUpload.on('click',function (e){
                e.preventDefault();
                var fileuploadID=$(this).attr('fileid');
               // alert('#'+fileuploadID);
                $('#input-'+fileuploadID).trigger('click');
             // $('#showImage').empty();
                var imagetag='  <img id="i'+fileuploadID+'" src="..." class="card-img-top" alt="...">';
                $(this).append(imagetag);
                $('#input-'+fileuploadID).on('change',function (){

               readUrl(this,fileuploadID);
                $(document).on('click','.remove-'+fileuploadID,function (e){
                    e.preventDefault();

                    resetFileUpload('#'+fileuploadID,'i'+fileuploadID,fileuploadID);


                });


                });

            });
              $('.remove-image-upload').on('click',function (e){
                  e.preventDefault();
                  fileuploadID=$(this).attr('fileid');
                  alert($(this).attr('image_id'));
                  $(this).addClass('d-none');
                  $.ajax({
                      type:'post',
                      url: "{{route('delete-image')}}",
                      data:{
                          '_token':"{{csrf_token()}}",
                          'image_id':$(this).attr('image_id'),
                      },
                      success: function(data){
                          alert(data.success);
                      }
                  });
                  resetFileUpload('#input-'+fileuploadID,'i'+fileuploadID,fileuploadID);

              });


              function  readUrl(input,imageId){
                  if(input.files&&input.files[0]){
                      var reader=new FileReader();
                      reader.onload=function (e){
                          //console.log(e.target.result);
                          $(input).parent().parent().find('.remove-'+imageId).removeClass('d-none');
                          $('#i'+imageId).attr('src',e.target.result);
                      }
                      reader.readAsDataURL(input.files[0]);
                  }

              }

              function resetFileUpload(fileUploadID,imageID,inputeImage){
               //  alert('#input-'+inputeImage);
                  $('#'+imageID).remove();
                  $('.remove-'+inputeImage).addClass('d-none');
                  // $(inputeImage).val('');
                  $('#input-'+inputeImage).val('');
                 // $('.image-card-upload').append('<input type="file" name="product_image[]" class="form-control-file image-file-upload" id="input-'+inputeImage+'" >')

              }

          });

      </script>

      @stop
