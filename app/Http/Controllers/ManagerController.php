<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class ManagerController extends Controller
{
    public function index(){
       $user = Auth::user()->user_type;
       return view('Backend/Manager/index');
    }
}
