<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles=Role::paginate(env('PAGENATION_COUNT'));
        return view('admin.roles.roles',compact('roles'));
    }

    public function store(Request $request){
        $request->validate([

            'role_name'=>'required|unique:roles,role',

        ]);

        $role=new Role();
        $role->role=$request->role_name;

        $role->save();


        return redirect()->back()->with(['success'=>'add is success']);

    }

    public function delete(Request $request){
        if (empty($request->role_id))
            return redirect()->back()->with(['success'=>'id is required']);
        $id=$request->role_id;
        if( Role::find($id)->delete())
            return redirect()->back()->with(['success'=>'delete is success']);

        return redirect()->back()->with(['success'=>'delete is not success']);

    }


    public function update(Request $request){
        //return  $request;
        $rules=  $request->validate([

            'edit_role_name'=>'required|unique:roles,role,'.$request->id,

        ]);
//        $validator = Validator::make($request->all(), $rules,$this->getErrors());
//        if ($validator->fails()) {
//            return redirect()->back()->with(['success'=>$validator->errors()]);
//        }
        $role=Role::find($request->id);
        if(!$role)
            return redirect()->back()->with(['success'=>'not found unit']);


        $role->role=$request->edit_role_name;

        $role->save();
        return redirect()->back()->with(['success'=>'done edit']);
    }
//    public function getErrors(){
//        return  $erroes=[
//            'edit_unit_name.required'=> "unit name required",
//            'edit_unit_code.required'=> "unit code required",
//            'edit_unit_code.unique'=> "unit code has been taken",
//            'edit_unit_name.unique'=> "unit name has been taken",
//        ];
//    }


    public function search(Request  $request){
        $request->validate([
            'role_search'=>'required'
        ]);
        $search_role=$request->role_search;
        $roles=Role::where('role','like','%'.$search_role.'%')->get();
        if (!($roles->count()>0)) {
            $roles = null;
            return view('admin.roles.roles')->with(['success' => "ssssss"]);
        }
        return view('admin.roles.roles',compact('roles'));
    }

}
