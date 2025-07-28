<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index(){
       $user_type = Auth::user()->user_type;
        // for adding user types
        if($user_type=='admin'){
            return redirect()->intended('/admin');
        }elseif($user_type=="leader"){
            return redirect()->intended('leader');
        }elseif($user_type=="user"){
            return redirect()->intended('user');
        }
    }
}
