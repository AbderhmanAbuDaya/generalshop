<?php

namespace App\Http\Controllers\api;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
     return  CategoryResource::collection(Categories::paginate());
//        return response()->json([
//           'categories'=>$cateogires
//        ]);
    }
    public function show($id){
        return new CategoryResource(Categories::find($id));
    }
}
