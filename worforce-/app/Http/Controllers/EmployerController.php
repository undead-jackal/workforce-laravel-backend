<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\DataPayload;
use Illuminate\Support\Facades\DB;


class EmployerController extends Controller{

    public function create(Request $request){
        $data_job = array(
            'title' =>$request->input('title'),
            'description'=> $request->input('desc'),
            'requirement'=> $request->input('req'),
            'owner' =>$request->input('id'),
            'skills'=>json_encode($request->input('value')),
            'level' => intval($request->input('level')),
            'paymentType' =>$request->input('payType'),
            'hourlyRate' =>$request->input('hourlyRate'),
            'fixedRate' =>$request->input('fixedRate'),
            'minHour'=>$request->input('minHours'),
            'maxHour'=>$request->input('maxHours'),
        );
        $jobId = DataPayload::insertData('job',$data_job);
        $freelancer = $request->input('freelancer');
        for ($i=0; $i < count($freelancer) ; $i++) {
            $data_invite = array(
                'applicant' =>$freelancer[$i],
                'applicant_type' => 0,
                'proposal'=>'',
                'type'=>0,
                'job' => $jobId,
                'inviter'=>$request->input('id'),
                'inviter_type'=> $request->input('role'),
            );
            $invite = DataPayload::insertData('application',$data_invite);
        }
        return response()->json([
            'status' => true,
            'data' => $data_job
        ]);
    }

    public function filteredFreelancer(Request $request){
        $freelancers = DB::table('user_info')
        ->select('user_info.fname','user_info.lname','user_info.credential','user_info.level','user_info.skills','user_info.skills')
        ->where(
            array(
                array('level', '>=', $request->input('level')),
                array('user_credentials.role', '=', 0),
                array('application.applicant', '=', null),
            ),
        )
        ->leftJoin('application', function($join)
        {
            $join->on('application.applicant','=','user_info.credential');
        })
        ->join('user_credentials','user_info.credential','=','user_credentials.id')
        ->get();
        $static_skill = json_decode($request->input('skill'));
        $result = array();
        foreach ($freelancers as $key){
            if($key->skills != null){
                $skills_f = json_decode($key->skills);
                for ($i=0; $i < count($static_skill); $i++) {
                    for ($j=0; $j < count($skills_f); $j++) {
                        if ($static_skill[$i]->name == $skills_f[$j]->name) {
                            array_push($result, $key);
                        }
                    }
                }
            }
        }
        return response()->json([
            'status' => true,
            'user'   => array_unique($result,SORT_REGULAR)
        ]);
    }

    public function getJobs(Request $request){
        return DataPayload::getData(array(
            "table" => 'job',
            "select" => array(
                'job.*'
            ),
            "where" =>array(
                array('job.owner','=',$request->input('id')),
            )
        ));
    }

    public function getJobDetail(Request $request){
        return DataPayload::getData(array(
            "table" => 'job',
            "select" => array(
                'job.*'
            ),
            "where" =>array(
                array('job.id','=',$request->input('jobId')),
            )
        ));
    }

    public function getApplicants(Request $request){
        $id = $request->input('jobId');
        return response()->json([
            'status' => true,
            "applicant" => DataPayload::getData(array(
                "table" => 'application',
                "select" => array('application.*', 'user_info.fname','user_info.lname','user_info.credential','job.title','job.id as jobId'),
                "where" =>array(
                    array("application.job", '=',$id),
                    array("application.status", '<',3),
                ),
                "join" => array(
                    array('user_info', 'application.applicant', '=', 'user_info.credential'),
                    array('job', 'application.job', '=', 'job.id')

                )
            )),
        ]);
    }

    public function getInterviews(Request $request){
        $id = $request->input('jobId');
        return DataPayload::getData(array(
            'table' => 'interview',
            'select' => array('interview.sched','application.applicant','application.id as app_id','application.status',"application.job","user_info.fname","user_info.lname"),
            'where' => array(
                array('application.job','=',$id),
                array('application.status','!=',10),
                array('application.status','<=',3)

            ),
            "join" => array(
                array('application', 'interview.applicants', '=', 'application.id'),
                array('job', 'application.job', '=', 'job.id'),
                array('user_info','application.applicant','=','user_info.credential')
            )
        ));
    }

    public function getEmployee(Request $request){
        $id = $request->input('jobId');
        return response()->json([
            'status' => true,
            "employee" => DataPayload::getData(array(
                "table" => 'employee',
                "select"=> array('user_info.fname','user_info.lname','employee.id as empId','employee.job','employee.status','employee.doing','employee.payment','employee.totalHours','job.paymentType'),
                "where" =>array(
                    array("employee.job", '=',$id),
                ),
                "join" => array(
                    array('user_info', 'employee.employee', '=', 'user_info.credential'),
                    array('job', 'employee.job', '=', 'job.id'),
                )
            )),
        ]);
    }

    public function hire(Request $request){
        $hired_data = array(
            'employee' => $request->input('employee'),
            'job'=>$request->input('job')
        );
        $hire = DataPayload::insertData('employee',$hired_data);
        $data = array(
            "status" => 10
        );
        $update = DataPayload::updateData(
            'application',
            $data,
            array(
                array('id', $request->input('application'))
            ),
        );
        return response()->json([
            'status' => $update,
        ]);
    }

    public function updateProfile(Request $request){
        $data = array(
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'address' => $request->input('address'),
            'contacts' =>json_encode($request->input('contact')),
            'emails' =>json_encode($request->input('email')),
            'company_address'=>$request->input('company_address'),
            'company' =>$request->input('company_name'),
            'company_email'=>json_encode($request->input('company_email')),
            'company_contact'=>json_encode($request->input('company_contact')),
            'status' => 1,
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

    public function setInterview(Request $request){
        $interview = array(
            'applicants' => $request->input('applicant'),
            'sched'=>$request->input('sched')
        );
        $sched = DataPayload::insertData('interview',$interview);

        $data = array(
            'status' => 3,
        );
        $update = DataPayload::updateData(
            'application',
            $data,
            array(
                array('id', $request->input('applicant'))
            ),
        );

        $key = uniqid('interview-1311998',TRUE);
        $addsolo = DataPayload::insertData('solo_chat',
            array(
                'title'=>$request->input('title'),
                'job'=>$request->input('job'),
                'application' => $request->input('applicant'),
                'user'=>$request->input('user'),
                'key'=>$key,
            )
        );
        return response()->json([
            'status' => true,
        ]);
    }

    public function getSoloKey(Request $request){
        return DataPayload::getData(array(
            'table' => 'solo_chat',
            'select'=> array('key'),
            'where' => array(
                array('job','=',$request->input('jobId')),
                array('user','=',$request->input('user'))
            ),
        ));
    }

    public function getFreelancer(Request $request){
        if ($request->input('single')) {
            $select = array('user_info.*');
            $where =array(
                array("user_credentials.id", '=',$request->input('id'))
            );
        }else{
            $select = array('user_info.fname','user_info.lname','user_info.level','user_info.credential');
            $where =array(
                array("user_credentials.role", '=',0),
            );
        }
        $freelancer = DataPayload::getData(array(
            'table' => 'user_credentials',
            'select'=>$select,
            "where" =>$where,
            "join" => array(
                array('user_info', 'user_credentials.id', '=', 'user_info.credential'),
            )
        ));
        return response()->json([
            'status' => true,
            'data' => $freelancer,
        ]);
    }

    public function getLogs(Request $request){
        return DataPayload::getData(array(
            'table' => 'employee_log',
            'where' => array(
                array('job','=',$request->input('id')),
            ),
        ));
    }


}
