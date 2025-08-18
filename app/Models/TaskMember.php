<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;

class TaskMember extends Model
{
    use HasFactory;
    public function members()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }

    
}
