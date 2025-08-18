<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [EmployeeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile_image',[ProfileController::class,'profile_image'])->name('profile_image');
    // User part
    Route::get('/user', [UserController::class,'index']);
    
    // Leader part
    Route::get('/leader',[LeaderController::class,'index']);
    
    // Manager part
    Route::get('/admin',[ManagerController::class,'index']);
    Route::get('/tables',[ManagerController::class,'table'])->name('table');
    Route::get('/form',[ManagerController::class,'forms'])->name('forms');
    Route::post('/add_task',[ManagerController::class,'add_task'])->name('add_task');
    Route::get('/add_proect_member',[ManagerController::class,'add_proect_member']);
    Route::post('/add_task_member',[ManagerController::class,'add_task_member'])->name('add_task_member');

});

require __DIR__.'/auth.php';
