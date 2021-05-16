<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helper\DataPayload;

class FreelancerController extends Controller{

    public function getInterview(Request $request){
        if($request->input('onlySched')){
            $select= array('sched');
            $where=array(
                array('interview.applicants', '=',$request->input('id'))
            );
            $join= array(
                array('application', 'interview.applicants', '=', 'application.id')
            );
        }
        $result = DataPayload::getData(array(
            "table" => 'interview',
            "select" => $select,
            "where" =>$where,
            "join" =>$join
        ));
        return $result;
    }

    public function fetchJobs(Request $request){
        $id = (int)$request->input("id");

        $jobs = DB::table('job')
        ->select('job.*')
        ->where('job.status', '=', 0)
        ->Where('application.applicant','=' ,null)
        ->leftJoin('application', function($join) use ($id)
        {
            $join->on('application.job', '=', 'job.id');
            $join->on('application.applicant','=',DB::raw($id));
        })
        ->get();
        return $jobs;
    }

    public function updateProfile(Request $request){
        $data = array(
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'address' => $request->input('address'),
            'contacts' =>json_encode($request->input('contact')),
            'emails' =>json_encode($request->input('email')),
            'pagibig' => $request->input('pag'),
            'sss' => $request->input('sss'),
            'philhealth' => $request->input('phi'),
            'tin' => $request->input('tin'),
            'employement'=>$request->input('employment'),
            'education' =>$request->input('education'),
            'languages' =>$request->input('language'),
            'skills' =>$request->input('skills'),
            'description'=>$request->input('cover'),
            'status' => 3,
        );
        $update = DataPayload::updateData(
            'user_info',
            $data,
            array(
                array('credential', $request->input('id'))
            ),
        );
        return response()->json([
            'status' => $update,
        ]);
    }

    public function getJobDetail(Request $request){
        return DataPayload::getData(array(
            "table" => 'job',
            "select" => array(
                'job.*'
            ),
            "where" =>array(
                array('job.id','=',$request->input('id')),
            )
        ));
    }

    public function updateInvite(Request $request){
        $data = array(
            "status" => 1
        );
        $update = DataPayload::updateData(
            'application',
            $data,
            array(
                array('id', $request->input('id'))
            ),
        );
        return response()->json([
            'status' => $update,
        ]);
    }

    public function submitProposal(Request $request){
        $insert = DataPayload::insertData('application',
            array(
                "type" => 1,
                "proposal" => $request->input('proposal'),
                "job" => $request->input('job'),
                "applicant" => $request->input('id'),
                "applicant_type" => $request->input('role'),
                "status" => 2,
            )
        );
        return response()->json([
            'status' => $insert,
            'jobs' => $this->fetchJobs($request)
        ]);
    }

    public function getApplication(Request $request){
        return DataPayload::getData(array(
            "table" => 'application',
            "select" => array('application.id as application_id', 'application.status as application_stat', 'application.applicant','application.applicant_type','application.type','application.inviter','application.inviter_type','job.title','job.description','job.id as job_id','job.paymentType'),
            "where" =>array(
                array('job.status', '=', 0),
                array('application.status', '!=', 10),
                array('application.applicant', '=', $request->input('id')),
                array('application.applicant_type', '=', $request->input('role')),
            ),
            "join" => array(
                array('job', 'application.job', '=', 'job.id'),
            )
        ));
    }

    public function myJobs(Request $request){
        return DataPayload::getData(array(
            "table" => 'employee',
            "select" => array('employee.id', 'user_info.fname', 'user_info.lname','employee.job','job.title','job.id as jobId', 'employee.totalHours','employee.payment'),
            "where" =>array(
                array("employee.employee", '=',$request->input('id')),
            ),
            
            "join" => array(
                array('job', 'employee.job', '=', 'job.id'),
                array('user_info', 'job.owner', '=', 'user_info.credential')
            )
        ));
    }

    public function getLogs(Request $request){
        $employee = DataPayload::getData( array(
            'table' => 'employee',
            'select' => array('employee.id','employee.job','employee.doing','employee.payment','employee.totalHours','job.paymentType','job.hourlyRate','job.fixedRate','job.minHour','job.maxHour'),
            'where'=>array(
                array('employee.employee','=',$request->input('user'))
            ),
            'join' => array(
                array('job', 'employee.job','=','job.id')
            )
        ));
        $logs = DataPayload::getData(array(
            'table' => 'employee_log',
            'where' => array(
                array('job','=',$request->input('job')),
                array('user','=',$request->input('user'))
            ),
        )); 

        return array(
            'details' => $employee,
            'logs'=>$logs
        );
    }

    public function addLogStatus(Request $request){
        $data_logs = array(
            "user" => $request->input('user'),
            "job" => $request->input('job'),
            "status" =>$request->input('status'),
            "time_stepped" => $request->input('time_stepped'),
        );
        $logs = DataPayload::insertData('employee_log',$data_logs);
        return response()->json([
            'id' => $logs,
        ]);
    }

    public function updateLog(Request $request){
        $update = DataPayload::updateData(
            'employee_log',
            array(
                "updated_at" => now(),
                "time_stepped" => $request->input('time_stepped'),
                "pays" => $request->input('total_payout')

            ),
            array(
                array('id', $request->input('id'))
            )
        );

        $data = DataPayload::updateData(
            'employee',
            array(
                "payment" => DB::raw('payment + '. $request->input('total_payout') ),
                "totalHours" => DB::raw('totalHours + '. $request->input('time_stepped') )
            ),
            array(
                array('id', $request->input('empId'))
            )
        );

        return $data;
    }

}
