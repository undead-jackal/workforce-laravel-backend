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

Auth::routes();
Route::post('/handleLogin', [App\Http\Controllers\Auth\LoginController::class,'handleLogin']);
Route::get('/registerFreelancer', [App\Http\Controllers\Auth\RegisterController::class,'registerFreelancer']);
Route::get('/registerEmployer', [App\Http\Controllers\Auth\RegisterController::class,'registerEmployer']);
Route::get('/registerCoordinator', [App\Http\Controllers\Auth\RegisterController::class,'registerCoordinator']);

Route::post('/handleRegisterFreelance', [App\Http\Controllers\Auth\RegisterController::class,'handleRegisterFreelance']);
Route::post('/handleRegisterEmployer', [App\Http\Controllers\Auth\RegisterController::class,'handleRegisterEmployer']);
Route::post('/handleRegisterCoordinator', [App\Http\Controllers\Auth\RegisterController::class,'handleRegisterCoordinator']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['freelancer', 'auth'])->group(function () {
    Route::get('freelancer/', [App\Http\Controllers\FreelancerController::class, 'index']);
    Route::get('freelancer/jobs', [App\Http\Controllers\FreelancerController::class, 'fetchJobsView']);
    Route::get('freelancer/jobInvites', [App\Http\Controllers\FreelancerController::class, 'jobInvitesView']);
    Route::get('freelancer/myJobs', [App\Http\Controllers\FreelancerController::class, 'myJobsView']);
    Route::post('freelancer/cancelInvite', [App\Http\Controllers\FreelancerController::class, 'cancelInvite']);
    Route::post('freelancer/getJobDetails', [App\Http\Controllers\FreelancerController::class, 'getJobDetails']);
    Route::post('freelancer/acceptInvite', [App\Http\Controllers\FreelancerController::class, 'acceptInvite']);
    Route::post('freelancer/submitProposal', [App\Http\Controllers\FreelancerController::class, 'submitProposal']);
    Route::post('freelancer/getInterviewSched', [App\Http\Controllers\FreelancerController::class, 'getInterviewSched']);
    Route::get('freelancer/messenger', [App\Http\Controllers\FreelancerController::class, 'messenger']);
    Route::post('freelancer/recordChats', [App\Http\Controllers\FreelancerController::class, 'recordChats']);
    Route::post('freelancer/getChats', [App\Http\Controllers\FreelancerController::class, 'getChats']);
    Route::post('freelancer/floaterGetGroup', [App\Http\Controllers\FreelancerController::class, 'floaterGetGroup']);
    Route::post('freelancer/floaterGetSolo', [App\Http\Controllers\FreelancerController::class, 'floaterGetSolo']);
});
Route::middleware(['employer', 'auth'])->group(function () {
    Route::get('employer/', [App\Http\Controllers\EmployerController::class, 'index']);
    Route::get('employer/create_job', [App\Http\Controllers\EmployerController::class, 'createJobView']);
    Route::post('employer/getAllFreelancers', [App\Http\Controllers\EmployerController::class, 'getAllFreelancers']);
    Route::get('employer/jobPosts', [App\Http\Controllers\EmployerController::class, 'jobList']);
    Route::get('employer/job', [App\Http\Controllers\EmployerController::class, 'jobPageSingle']);
    Route::get('employer/room', [App\Http\Controllers\EmployerController::class, 'roomView']);
    Route::get('employer/messenger', [App\Http\Controllers\EmployerController::class, 'messenger']);
    Route::post('employer/getCoordinators', [App\Http\Controllers\EmployerController::class, 'getCoordinators']);
    Route::post('employer/getDataFreelancer', [App\Http\Controllers\EmployerController::class, 'getDataFreelancer']);
    Route::post('employer/getDataCoordinator', [App\Http\Controllers\EmployerController::class, 'getDataCoordinator']);
    Route::post('employer/createJob', [App\Http\Controllers\EmployerController::class, 'createJob']);
    Route::post('employer/setInterview', [App\Http\Controllers\EmployerController::class, 'setInterview']);
    Route::post('employer/setInterview', [App\Http\Controllers\EmployerController::class, 'setInterview']);
    Route::post('employer/getInterviews', [App\Http\Controllers\EmployerController::class, 'getInterviews']);
    Route::post('employer/getApplicants', [App\Http\Controllers\EmployerController::class, 'getApplicants']);
    Route::post('employer/getJobDetail', [App\Http\Controllers\EmployerController::class, 'getJobDetail']);
    Route::post('employer/updateInterview', [App\Http\Controllers\EmployerController::class, 'updateInterview']);
    Route::post('employer/hire', [App\Http\Controllers\EmployerController::class, 'hire']);
    Route::post('employer/getEmployee', [App\Http\Controllers\EmployerController::class, 'getEmployee']);
    Route::post('employer/recordChats', [App\Http\Controllers\EmployerController::class, 'recordChats']);
    Route::post('employer/getChats', [App\Http\Controllers\EmployerController::class, 'getChats']);
    Route::post('employer/floaterGetGroup', [App\Http\Controllers\EmployerController::class, 'floaterGetGroup']);
    Route::post('employer/floaterGetSolo', [App\Http\Controllers\EmployerController::class, 'floaterGetSolo']);
});
Route::middleware(['coordinator', 'auth'])->group(function () {
    Route::get('coordinator/', [App\Http\Controllers\CoordinatorController::class, 'index']);
    Route::get('coordinator/myjobs', [App\Http\Controllers\CoordinatorController::class, 'myjobs']);
    Route::get('coordinator/application', [App\Http\Controllers\CoordinatorController::class, 'application']);
    Route::get('coordinator/room', [App\Http\Controllers\CoordinatorController::class, 'room']);
    Route::get('coordinator/messenger', [App\Http\Controllers\CoordinatorController::class, 'messenger']);
    Route::post('coordinator/acceptInvite', [App\Http\Controllers\CoordinatorController::class, 'acceptInvite']);
    Route::post('coordinator/getApplicant', [App\Http\Controllers\CoordinatorController::class, 'getApplicant']);
    Route::post('coordinator/getFreelancer', [App\Http\Controllers\CoordinatorController::class, 'getFreelancer']);
    Route::post('coordinator/Invite', [App\Http\Controllers\CoordinatorController::class, 'Invite']);
    Route::post('coordinator/getJobDetail', [App\Http\Controllers\CoordinatorController::class, 'getJobDetail']);
    Route::post('coordinator/setInterview', [App\Http\Controllers\CoordinatorController::class, 'setInterview']);
    Route::post('coordinator/getInterviews', [App\Http\Controllers\CoordinatorController::class, 'getInterviews']);
    Route::post('coordinator/updateInterview', [App\Http\Controllers\CoordinatorController::class, 'updateInterview']);
    Route::post('coordinator/recordChats', [App\Http\Controllers\CoordinatorController::class, 'recordChats']);
    Route::post('coordinator/getChats', [App\Http\Controllers\CoordinatorController::class, 'getChats']);
    Route::post('coordinator/floaterGetGroup', [App\Http\Controllers\CoordinatorController::class, 'floaterGetGroup']);
    Route::post('coordinator/floaterGetSolo', [App\Http\Controllers\CoordinatorController::class, 'floaterGetSolo']);
    Route::post('coordinator/hire', [App\Http\Controllers\CoordinatorController::class, 'hire']);
    Route::post('coordinator/getEmployee', [App\Http\Controllers\CoordinatorController::class, 'getEmployee']);

});
