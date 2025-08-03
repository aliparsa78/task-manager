<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LeaderController extends Controller
{
    public function index(){
       $user = Auth::user()->user_type;
       return view('dashboard');
    }
}
