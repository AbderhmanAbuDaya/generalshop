<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries =Country::paginate(env('PAGENATION_COUNT'));
return view('admin.countries.countries', compact('countries'));
}
    public function store(Request $request){
        $request->validate([

            'country_name'=>'required|unique:countries,name',
            'phone_code'=>'required|unique:countries,phoneCode',
            'currency'=>'required',
            'capital'=>'required'
        ]);

        $country=new Country();
        $country->name=$request->country_name;
        $country->phoneCode=$request->phone_code;
        $country->currency=$request->currency;
        $country->capital=$request->capital;
        $country->save();


        return redirect()->back()->with(['success'=>'add is success']);

    }

    public function delete(Request $request){
        if (empty($request->country_id))
            return redirect()->back()->with(['success'=>'id is required']);
        $id=$request->country_id;
        if( Country::find($id)->delete())
            return redirect()->back()->with(['success'=>'delete is success']);

        return redirect()->back()->with(['success'=>'delete is not success']);

    }


    public function update(Request $request){
        //return  $request;
        $rules=  $request->validate([

            'edit_country_name'=>'required|unique:countries,name,'.$request->id,
            'edit_phone_code'=>'required|unique:countries,phonecode,'.$request->id,
            'edit_capital'=>'required|unique:countries,capital,'.$request->id,
            'edit_currency'=>'required'
        ]);
//        $validator = Validator::make($request->all(), $rules,$this->getErrors());
//        if ($validator->fails()) {
//            return redirect()->back()->with(['success'=>$validator->errors()]);
//        }
        $country=Country::find($request->id);
        if(!$country)
            return redirect()->back()->with(['success'=>'not found unit']);

        $country->phonecode=$request->edit_phone_code;
        $country->name=$request->edit_country_name;
        $country->capital=$request->edit_capital;
        $country->currency=$request->edit_currency;

        $country->save();
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
            'country_search'=>'required'
        ]);
        $search_country=$request->country_search;
        $countries=Country::where('name','like','%'.$search_country.'%')->get();
        if (!($countries->count()>0)) {
            $countries = null;
            return view('admin.countries.countries')->with(['success' => "ssssss"]);
        }
        return view('admin.countries.countries',compact('countries'));
    }

}
