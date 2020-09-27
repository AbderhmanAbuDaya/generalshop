<?php

namespace App\Http\Controllers\api;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use http\Env\Response;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index(){
        return  CategoryResource::collection(Country::paginate());
//        return response()->json([
//           'categories'=>$cateogires
//        ]);
    }
    public function show($id){
        return new CategoryResource(Country::find($id));
    }
    public function showCities($id){
        $country=Country::find($id);
        if (!is_null($country))
        return CityResource::collection($country->cities);
        return response()->json([
            'msg'=>'Not found country',
            'status'=>404
        ]);
    }
    public function showStates($id){
        $country=Country::find($id);
        if (!is_null($country))
        return StateResource::collection($country->states);
        return response()->json([
            'msg'=>'Not found country',
            'status'=>404
        ]);
    }
}
