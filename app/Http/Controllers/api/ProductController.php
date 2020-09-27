<?php

namespace App\Http\Controllers\api;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TagResource;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
     return  ProductResource::collection(Product::paginate());
//        return response()->json([
//           'categories'=>$cateogires
//        ]);
    }
    public function show($id){
        return new ProductResource(Product::find($id));
    }
}
