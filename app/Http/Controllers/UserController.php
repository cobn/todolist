<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function signup(Request  $request){
$uc=User::where("email",$request->email)->count();
        if($uc==0)
        {   User::create(["name"=>$request->name,"email"=>$request->email,"password"=>Hash::make($request->password),'type'=>1]);

            return json_encode(["success"=>"1"]);
        }
        else{
            return json_encode(["success"=>"0"]);

        }


    }

}
