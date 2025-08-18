<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskMember;
use Auth;
use DB;


class ManagerController extends Controller
{
    public function index(){
       $user = Auth::user()->user_type;
       return view('Backend/Manager/index');
    }

    public function table()
    {
        $taskMembers = DB::table('task_members')
            ->join('users','task_members.user_id','=','users.id')


            ->select('task_members.task_id','users.*')
            ->get()
            ->groupBy('task_id');

        return view('Backend/Manager/table', compact('taskMembers'));
    }
    public function forms(){
        
        return view('Backend/Manager/form');
    }
    public function add_task(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->descriptions = $request->description;
        $task->status = $request->status;
        $task->due_date = $request->date;
        $task->save();
       
        return redirect('add_proect_member');
    }

    public function add_proect_member (){
         $tasks = Task::get();  
        $users = User::get();
        return view('Backend/Manager/project_member',compact('tasks','users'));

    }
    public function add_task_member(Request $request)
    {
        $task = Task::find($request->task_id);
        
        $task->members()->attach($request->user_id);
        return back();
    }
}
