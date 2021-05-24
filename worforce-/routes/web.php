<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('employer', [App\Http\Controllers\EmployerController::class, 'jobList_view']);
Route::get('employer/manage', [App\Http\Controllers\EmployerController::class, 'manage_view']);
Route::get('employer/manage/applicants', [App\Http\Controllers\EmployerController::class,'applicant_view']);
Route::get('employer/profile', [App\Http\Controllers\EmployerController::class,'profile_view']);
Route::get('employer/wallet', [App\Http\Controllers\EmployerController::class,'wallet_view']);
Route::get('employer/login', [App\Http\Controllers\EmployerController::class,'login']);
Route::get('employer/register', [App\Http\Controllers\EmployerController::class,'register']);