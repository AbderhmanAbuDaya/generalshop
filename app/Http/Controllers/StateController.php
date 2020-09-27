<?php

namespace App\Http\Controllers;

use App\Country;
use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states =State::with('country')->paginate(env('PAGENATION_COUNT'));
        $countries=Country::get();
        return view('admin.states.states', compact(['states','countries']));
    }
    public function store(Request $request){
        $request->validate([

            'state_name'=>'required|unique:states,name',
            'country_name'=>'required',
        ]);
        $country=Country::find($request->country_name) ;
        if(!is_null($country)):
        $state=new State();
        $state->name=$request->state_name;
        $state->country_id=$request->country_name;
        $state->country_code=$country->iso2;


        $state->save();


        return redirect()->back()->with(['success'=>'add is success']);
        endif;
        return redirect()->back()->with(['success'=>'try agin']);


    }
    public function delete(Request $request){
        if (empty($request->state_id))
            return redirect()->back()->with(['success'=>'id is required']);
        $id=$request->state_id;
        if( State::find($id)->delete())
            return redirect()->back()->with(['success'=>'delete is success']);

        return redirect()->back()->with(['success'=>'delete is not success']);

    }


    public function update(Request $request){
        //return  $request;
        $rules=  $request->validate([

            'edit_state_name'=>'required|unique:tags,tag,'.$request->id,
            'edit_state_country'=>'required'
        ]);
//        $validator = Validator::make($request->all(), $rules,$this->getErrors());
//        if ($validator->fails()) {
//            return redirect()->back()->with(['success'=>$validator->errors()]);
//        }

        $state=State::find($request->id);
        if(empty($state))
            return redirect()->back()->with(['success'=>'not found unit']);
     $country=Country::find($request->edit_state_country);
        $state->name=$request->edit_state_name;
        $state->country_id=$request->edit_state_country;
        $state->country_code=$country->iso2;
        $state->save();
        return redirect()->back()->with(['success'=>'done edit']);
    }
//    public function getErrors(){
//        return  $erroes=[
//            'edit_tag_name.required'=> "unit name required",
//            'edit_tag_name.unique'=> "unit name has been taken",
//        ];
//    }

//
    public function search(Request  $request){
        $request->validate([
            'state_search'=>'required'
        ]);

        $search_state=$request->state_search;
        $states=State::where('name','like','%'.$search_state.'%')->get();
        $countries=Country::get();

        if (!($states->count()>0)) {

            $states = null;
            return view('admin.states.states',compact(['states','countries']))->with(['success' => "not  found"]);
        }

        return view('admin.states.states',compact(['states','countries']));
    }
}
