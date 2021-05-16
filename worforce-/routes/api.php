<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login/', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('profile', [App\Http\Controllers\AuthController::class, 'getProfile']);
Route::post('recordChat', [App\Http\Controllers\AuthController::class, 'recordChat']);
Route::post('getChat', [App\Http\Controllers\AuthController::class, 'getChat']);
Route::post('getListChats', [App\Http\Controllers\AuthController::class, 'getListChats']);
Route::post('createNotification', [App\Http\Controllers\AuthController::class, 'createNotification']);
Route::post('getNotification', [App\Http\Controllers\AuthController::class, 'getNotification']);
Route::post('updateNotification', [App\Http\Controllers\AuthController::class, 'updateNotification']);
Route::post('checkSchedule', [App\Http\Controllers\AuthController::class, 'checkSchedule']);
Route::post('uploadImage', [App\Http\Controllers\AuthController::class, 'uploadImage']);
Route::post('userSetting', [App\Http\Controllers\AuthController::class, 'userSetting']);
Route::post('updateProfile', [App\Http\Controllers\AuthController::class, 'updateProfile']);

Route::post('employee/create_job', [App\Http\Controllers\EmployerController::class, 'create']);
Route::post('employee/getJobs', [App\Http\Controllers\EmployerController::class, 'getJobs']);
Route::post('employee/getJobDetail', [App\Http\Controllers\EmployerController::class, 'getJobDetail']);
Route::post('employee/getApplicants', [App\Http\Controllers\EmployerController::class, 'getApplicants']);
Route::post('employee/getInterviews', [App\Http\Controllers\EmployerController::class, 'getInterviews']);
Route::post('employee/getEmployee', [App\Http\Controllers\EmployerController::class, 'getEmployee']);
Route::post('employee/updateProfile', [App\Http\Controllers\EmployerController::class, 'updateProfile']);
Route::post('employee/setInterview', [App\Http\Controllers\EmployerController::class, 'setInterview']);
Route::post('employee/getFreelancer', [App\Http\Controllers\EmployerController::class, 'getFreelancer']);
Route::post('employee/hire', [App\Http\Controllers\EmployerController::class, 'hire']);
Route::post('employee/getSolokey', [App\Http\Controllers\EmployerController::class, 'getSolokey']);
Route::post('employee/filteredFreelancer', [App\Http\Controllers\EmployerController::class, 'filteredFreelancer']);
Route::post('employee/getLogs', [App\Http\Controllers\EmployerController::class, 'getLogs']);

Route::post('freelancer/fetchJobs', [App\Http\Controllers\FreelancerController::class, 'fetchJobs']);
Route::post('freelancer/getJobDetail', [App\Http\Controllers\FreelancerController::class, 'getJobDetail']);
Route::post('freelancer/submitProposal', [App\Http\Controllers\FreelancerController::class, 'submitProposal']);
Route::post('freelancer/getApplication', [App\Http\Controllers\FreelancerController::class, 'getApplication']);
Route::post('freelancer/updateProfile', [App\Http\Controllers\FreelancerController::class, 'updateProfile']);
// Route::post('freelancer/getChatsInterview', [App\Http\Controllers\FreelancerController::class, 'getChatsInterview']);
Route::post('freelancer/updateInvite', [App\Http\Controllers\FreelancerController::class, 'updateInvite']);
Route::post('freelancer/getInterview', [App\Http\Controllers\FreelancerController::class, 'getInterview']);
Route::post('freelancer/myJobs', [App\Http\Controllers\FreelancerController::class, 'myJobs']);
Route::post('freelancer/addLogStatus', [App\Http\Controllers\FreelancerController::class, 'addLogStatus']);
Route::post('freelancer/getLogs', [App\Http\Controllers\FreelancerController::class, 'getLogs']);
Route::post('freelancer/updateLog', [App\Http\Controllers\FreelancerController::class, 'updateLog']);
