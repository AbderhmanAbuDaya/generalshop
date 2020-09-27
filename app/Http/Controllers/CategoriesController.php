<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories=Categories::paginate(env('PAGENATION_COUNT'));
        return view('admin.categories.categories',compact('categories'));
    }
    public function store(Request $request){
        $request->validate([

            'category_name'=>'required|unique:units,unit_name',
        ]);

        $category=new Categories();
        $category->name=$request->category_name;

        $category->save();


        return redirect()->back()->with(['success'=>'add is success']);
    }
    public function delete(Request $request){
        if (empty($request->category_id))
            return redirect()->back()->with(['success'=>'id is required']);
        $id=$request->category_id;
        if( Categories::find($id)->delete())
            return redirect()->back()->with(['success'=>'delete is success']);

        return redirect()->back()->with(['success'=>'delete is not success']);

    }


    public function update(Request $request){
        //return  $request;
        $rules=  $request->validate([

            'edit_category_name'=>'required|unique:categories,name,'.$request->id,
        ]);
//        $validator = Validator::make($request->all(), $rules,$this->getErrors());
//        if ($validator->fails()) {
//            return redirect()->back()->with(['success'=>$validator->errors()]);
//        }

        $category=Categories::find($request->id);
        if(empty($category))
            return redirect()->back()->with(['success'=>'not found unit']);

        $category->name=$request->edit_category_name;
        $category->save();
        return redirect()->back()->with(['success'=>'done edit']);
    }
//    public function getErrors(){
//        return  $erroes=[
//            'edit_tag_name.required'=> "unit name required",
//            'edit_tag_name.unique'=> "unit name has been taken",
//        ];
//    }


    public function search(Request  $request){
        $request->validate([
            'category_search'=>'required'
        ]);
        $search_category=$request->category_search;
        $categories=Categories::where('name','like','%'.$search_category.'%')->get();

        if (!($categories->count()>0)) {
            $categories = null;
            return view('admin.categories.categories')->with(['success' => "not  found"]);
        }
        return view('admin.categories.categories',compact('categories'));
    }
}
