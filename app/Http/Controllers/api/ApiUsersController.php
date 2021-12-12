<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
//

class ApiUsersController extends Controller
{
  /**************************************
   *
   **************************************/  
  public function add(Request $request){
    $retArr = array('ret' => 1, 'message'=>"" );
    $password = request('password');
    $hashedPassword = Hash::make($password);
    $user = new User();
    $user->name   = request('name');
    $user->password   = $hashedPassword;
    $user->email   = request('email');    
    $user->save();
    return response()->json($retArr);
  }
  /**************************************
   *
   **************************************/  
  public function valid_login( $email, $password ,$request){
    $retArr = ['ret' => false, 'user'=>[] ];
    $hashedPassword = '';
    $user = User::orderBy('id', 'desc')
    ->where('email', $email)->get()->toArray();
//var_dump($user);
//exit();
//print_r(count($user));
    if(count($user) > 0){
      $userOne = $user[0];
      $hashedPassword = $userOne["password"];
      if (Hash::check($password , $hashedPassword)) {
        $userOne["password"] = "";
        $retArr["ret"] = true;
        $retArr["user"] = $userOne;
      }        
    }
    return $retArr;
  }
  /**************************************
   *
   **************************************/  
  public function login(Request $request){
    $retArr = array('ret' => 0, 'message'=>"", "user_id" => 0 );

    $valid = $this->valid_login(
      request('email'), request('password') , $request
    );
//var_dump($valid["user"]["id"]);
    if($valid["ret"]){
      $retArr = array('ret' => 1, 'message'=>"", "user_id" => $valid["user"]["id"]);
    }
    return response()->json($retArr);
  }
  /**************************************
   *
   **************************************/
  public function logout(Request $request)
  {
    return response()->json([]);
  }
  /**************************************
   *
   **************************************/      
  public function userCount(Request $request)
  {
    $count = User::orderBy('id', 'desc')
    ->count();
//  var_dump($count);
    return response()->json(['count' => $count]);
  }

}
