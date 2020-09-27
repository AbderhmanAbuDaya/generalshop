<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function insertUnit(){
    if (import()){
    return 'تم اضافة الوحدات';
    }
    return 'حاول مرة اخرى';
    }

    public function index(){
        $units=Unit::paginate(env('PAGENATION_COUNT'));
        return view('admin.units.units',compact('units'));
    }

    public function store(Request $request){
        $request->validate([

            'unit_name'=>'required|unique:units,unit_name',
            'unit_code'=>'required|unique:units,unit_code',
        ]);

         $unit=new Unit();
         $unit->unit_name=$request->unit_name;
         $unit->unit_code=$request->unit_code;
         $unit->save();


         return redirect()->back()->with(['success'=>'add is success']);

    }

    public function delete(Request $request){
        if (empty($request->unit_id))
            return redirect()->back()->with(['success'=>'id is required']);
        $id=$request->unit_id;
       if( Unit::find($id)->delete())
        return redirect()->back()->with(['success'=>'delete is success']);

        return redirect()->back()->with(['success'=>'delete is not success']);

    }


    public function update(Request $request){
        //return  $request;
      $rules=  $request->validate([

            'edit_unit_name'=>'required|unique:units,unit_name,'.$request->id,
            'edit_unit_code'=>'required|unique:units,unit_code,'.$request->id,
        ]);
//        $validator = Validator::make($request->all(), $rules,$this->getErrors());
//        if ($validator->fails()) {
//            return redirect()->back()->with(['success'=>$validator->errors()]);
//        }
        $unit=Unit::find($request->id);
        if(!$unit)
            return redirect()->back()->with(['success'=>'not found unit']);

            $unit->unit_code=$request->edit_unit_code;
            $unit->unit_name=$request->edit_unit_name;

   $unit->save();
        return redirect()->back()->with(['success'=>'done edit']);
    }
     public function getErrors(){
         return  $erroes=[
         'edit_unit_name.required'=> "unit name required",
         'edit_unit_code.required'=> "unit code required",
         'edit_unit_code.unique'=> "unit code has been taken",
         'edit_unit_name.unique'=> "unit name has been taken",
     ];
     }


     public function search(Request  $request){
        $request->validate([
            'unit_search'=>'required'
        ]);
        $search_unit=$request->unit_search;
         $units=Unit::where('unit_name','like','%'.$search_unit.'%')->orWhere('unit_code','like','%'.$search_unit.'%')->get();
        if (!($units->count()>0)) {
            $units = null;
            return view('admin.units.units')->with(['success' => "ssssss"]);
        }
        return view('admin.units.units',compact('units'));
     }
}
