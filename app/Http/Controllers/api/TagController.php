<?php

namespace App\Http\Controllers\api;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
     return  TagResource::collection(Tag::paginate());
//        return response()->json([
//           'categories'=>$cateogires
//        ]);
    }
    public function show($id){
        return new TagResource(Tag::find($id));
    }
}
