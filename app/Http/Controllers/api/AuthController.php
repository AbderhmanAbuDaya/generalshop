<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApiResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function register(Request $request){
      $request->validate([
          'first_name' => ['required', 'string', 'max:255'],
          'last_name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'mobile'=>'required|numeric|min:8',
          'password' => ['required', 'string', 'min:8'],
      ]);
      $data=$request->all();
      $user=new User();
          $user->first_name = $data['first_name'];
         $user-> last_name =$data['last_name'];
          $user->email =$data['email'];
          $user->password = Hash::make($data['password']);
          $user->api_token=bin2hex(openssl_random_pseudo_bytes(30));
      $user->save();
      return new UserApiResource($user);
  }
  public function login(Request $request){
      $request->validate([
          'email' => ['required', 'string', 'email', 'max:255'],
          'password'=>['required'],

      ]);
      $user=Auth::guard('web')->attempt($request->only(['email','password']));
      if (!$user)
          return response()->json([
              'error'=>true,
              'msg'=>"User login attempt failed"
          ]);

      return new UserApiResource(Auth::user());


  }
}
