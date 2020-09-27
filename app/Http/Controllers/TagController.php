<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Validator;

class TagController extends Controller
{
    public function index(){
        $tags=Tag::paginate(env('PAGENATION_COUNT'));
        return view('admin.tags.tags',compact('tags'));
    }
   public function store(Request $request){
       $request->validate([

           'tag_name'=>'required|unique:units,unit_name',
       ]);

       $tag=new Tag();
       $tag->tag=$request->tag_name;

       $tag->save();


       return redirect()->back()->with(['success'=>'add is success']);
   }
    public function delete(Request $request){
        if (empty($request->tag_id))
            return redirect()->back()->with(['success'=>'id is required']);
        $id=$request->tag_id;
        if( Tag::find($id)->delete())
            return redirect()->back()->with(['success'=>'delete is success']);

        return redirect()->back()->with(['success'=>'delete is not success']);

    }


    public function update(Request $request){
        //return  $request;
        $rules=  $request->validate([

            'edit_tag_name'=>'required|unique:tags,tag,'.$request->id,
        ]);
//        $validator = Validator::make($request->all(), $rules,$this->getErrors());
//        if ($validator->fails()) {
//            return redirect()->back()->with(['success'=>$validator->errors()]);
//        }

        $tag=Tag::find($request->id);
        if(empty($tag))
            return redirect()->back()->with(['success'=>'not found unit']);

        $tag->tag=$request->edit_tag_name;
        $tag->save();
        return redirect()->back()->with(['success'=>'done edit']);
    }
    public function getErrors(){
        return  $erroes=[
            'edit_tag_name.required'=> "unit name required",
            'edit_tag_name.unique'=> "unit name has been taken",
        ];
    }


    public function search(Request  $request){
        $request->validate([
            'tag_search'=>'required'
        ]);
        $search_tag=$request->tag_search;
        $tags=Tag::where('tag','like','%'.$search_tag.'%')->get();

        if (!($tags->count()>0)) {
            $tags = null;
            return view('admin.tags.tags')->with(['success' => "not  found"]);
        }
        return view('admin.tags.tags',compact('tags'));
    }
}
