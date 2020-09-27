<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Image;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function Sodium\add;

class ProductController extends Controller
{

    public function index(){
            $products=Product::with(['category','images'])->paginate(env('PAGENATION_COUNT'));
            $currencyCode=env('CURRENCY_CODE','$');
        return view('admin.products.products',compact(['products','currencyCode']));
    }

    public function update(Request $request){
        //dd ($request);
        $request->validate([
            'product_title'=>'required|unique:products,title,'.$request->product_id,
            'product_description'=>'required',
            'product_price'=>'required|numeric',
            'product_discount'=>'required|numeric',
            'product_total'=>'required|numeric',
            'product_unit'=>'required|numeric',
            'product_category'=>'required',
        ]);
   $product=Product::find($request->product_id);
   if(!is_null($product)){
       $product->title=$request->product_title;
       $product->description=$request->product_description;
       $product->price=$request->product_price;
       $product->discount=$request->product_discount;
       $product->total=$request->product_total;
       $product->unit=$request->product_unit;
       $product->category_id=$request->product_category;
       if ($request->has('options')){
           $optionArray=array();

           $options=array_unique($request->options);
           foreach ($options as $op){
               $optionName=$request->$op;
               $optionArray[$op]=[];
               foreach ($optionName as $key=> $value){

                   array_push($optionArray[$op],$value);

               }
           }
              $product->options=json_encode($optionArray);

       }
       $product->save();


           if($request->hasFile('product_image')){
        // dd($request->file('product_image'));
          // dd($request->file('product_image'));
           $images=$request->file('product_image');
           foreach ($images as $imageUp){
                $path=$imageUp->store('/',env('FILESYSTEM_DRIVER'));
               $image=new Image();
               $image->url=$path;
               $image->product_id=$product->id;
               $image->save();
           }
       }
       return redirect()->route('products')->with(['success'=>'edit is success']);
   }

   return redirect()->route('products')->with(['success'=>'cont fond product']);

    }
    public function store(Request  $request){
       // dd($request);
       // return $request;
        $request->validate([
            'product_title'=>'required|unique:products,title,',
            'product_description'=>'required',
            'product_price'=>'required|numeric',
            'product_discount'=>'required|numeric',
            'product_total'=>'required|numeric',
            'product_unit'=>'required|numeric',
            'product_category'=>'required',
        ]);


        $product=new Product();
        $product->title=$request->product_title;
        $product->description=$request->product_description;
        $product->price=$request->product_price;
        $product->discount=$request->product_discount;
        $product->total=$request->product_total;
        $product->unit=$request->product_unit;
        $product->category_id=$request->product_category;
        if ($request->has('options')){
            $optionArray=array();

            $options=array_unique($request->options);
            foreach ($options as $op){
                $optionName=array_unique($request->$op);
                $optionArray[$op]=[];
                foreach ($optionName as  $value){
                    array_push($optionArray[$op],$value);

                }
            }
            $product->options=json_encode($optionArray);

        }
        $product->save();

        if(!is_null($product)){
            if($request->hasFile('product_image')){
               // return "aa";
                   $images=$request->file('product_image');
                foreach ($images as $imageUp){
                    $path=$imageUp->store('/',env('FILESYSTEM_DRIVER'));
                    $image=new Image();
                    $image->url=$path;
                    $image->product_id=$product->id;
                    $image->save();
                }
            }
            return redirect()->route('products')->with(['success'=>'add is success']);
        }

        return redirect()->route('products')->with(['success'=>'add is not success']);


    }
    public function delete($id){

    }
    public function newProduct($id=null){
     $product=Product::with(['hasUnit','category'])->find($id);
     $units=Unit::get();
     $categories=Categories::get();
     return view('admin.products.new-product',compact(['product','units','categories']));
    }
  public function deleteImage(Request $request){
        $imageID=$request->image_id;
        $image=Image::find($imageID);
      $image_path ='product/images/'.$image->url;// Value is not URL but directory file path
      if(File::exists($image_path)) {
          File::delete($image_path);
      }
      if(Image::destroy($imageID)) {

          return response()->json([
              'success' => 'don delete image'
          ]);
      }else{
          return response()->json([
              'success' => 'not delete image'
          ]);
      }
  }
}
