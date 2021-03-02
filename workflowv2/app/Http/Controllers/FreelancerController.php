<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\AUTH;
use App\Helper\DataModel;

class FreelancerController extends Controller
{
    public function index(){
        return view('freelancer.index');
    }

    public function fetchJobsView(){
        return view('freelancer.fetchjobs')->with('jobs',$this->fetchJobs());
    }

    public function jobInvitesView(){
        return view('freelancer.jobInvites')->with('invites',$this->getInvites());
    }

    public function myJobsView(Request $request){
        return view('freelancer.myjobs')->with('data', $this->getMyJobs());
    }

    public function messenger(Request $request){
        return view('freelancer.chatRoom')->with('group',$this->groupChats());
    }

    // POST

    public function fetchJobs(){
        $jobs = DB::table('job')
        ->select('job.*','user_employer.fname','user_employer.lname','user_employer.company')
        ->where('job.status', '=', 0)
        ->Where('application.applicant','=' ,null)
        ->leftJoin('application', function($join)
        {
            $join->on('application.job', '=', 'job.id');
            $join->on('application.applicant','=',DB::raw(AUTH::user()->id));
        })      
        ->join('user_employer','job.owner','=','user_employer.credential')
        ->get();
        return $jobs;
    }

    public function getMyJobs(){
        $params = array(
            "table" => 'employee',
            "select" => array('employee.id as emp','employee.employee','employee.employee_type','employee.job','employee.status as emp_stats','job.*','user_employer.fname','user_employer.lname'),
            "where" =>array(
                array("employee.employee", '=',AUTH::user()->id),
            ),
            
            "join" => array(
                array('job', 'employee.job', '=', 'job.id'),
                array('user_employer', 'job.owner', '=', 'user_employer.credential')
            )
        );
        return DataModel::getData($params);
    }

    public function acceptInvite(Request $request){
        $updated_invite = DB::table('application')
        ->updateOrInsert(
            ['id' => $request->input('invite_id')],
            ['status' => 1]
        );
        return response()->json([
            'status' => $updated_invite,
            'new_invite' => $this->getInvites()
        ]);
    }

    public function getInterviewSched(Request $request){
        $params = array(
            'table' => 'interview',
            'where' => array(
                array('person_id','=',AUTH::user()->id),
                array('job_id','=',$request->input('job'))
            ),
        );
        $schedule = DataModel::getData($params);
        return response()->json([
                    'date' => $schedule[0]->date,
                    'reminder' => $schedule[0]->reminder
                ]);
    }


    public function cancelInvite(Request $request){
        $updated_invite = DB::table('invite')
        ->updateOrInsert(
            ['id' => $request->input('id')],
            ['status' => 3]
        );
        return response()->json([
            'status' => $updated_invite,
            'new_invite' => $this->getInvites()
        ]);
    }

    public function getInvites(){
        $params = array(
            "table" => 'application',
            "select" => array('application.id as application_id', 'application.status as application_stat', 'application.applicant','application.applicant_type','application.type','application.inviter','application.inviter_type','job.title','job.vacant','job.description','job.id as job_id','job.salary','user_employer.fname','user_employer.lname'),
            "where" =>array(
                array('job.status', '=', 0),
                array('application.status', '!=', 10),
                array('application.applicant', '=', AUTH::user()->id),
                array('application.applicant_type', '=', AUTH::user()->type),
            ),
            
            "join" => array(
                array('job', 'application.job', '=', 'job.id'),
                array('user_employer', 'job.owner', '=', 'user_employer.credential')
            )
        );
        return DataModel::getData($params);
    }


    public function getJobDetails(Request $request){
        if ($request->input('from')) {
            $job_details = DB::table('job')
            ->select('job.*','user_employer.fname','user_employer.lname','user_employer.company','application.type','application.status','application.id as app_id')
            ->where('job.id','=',$request->input('id'))
            ->where('application.applicant','=',AUTH::user()->id)
            ->join('application', 'job.id', '=', 'application.job')
            ->join('user_employer', 'job.owner', '=', 'user_employer.credential')
            ->get();
        }else{
            $job_details = DB::table('job')
            ->select('job.*','user_employer.fname','user_employer.lname','user_employer.company')
            ->where('job.id','=',$request->input('id'))
            ->join('user_employer', 'job.owner', '=', 'user_employer.credential')
            ->get();
        }
        return response()->json([
            'status' => true,
            'data' =>$job_details[0],
            'skills'=>json_decode($job_details[0]->skills)
        ]);
    }

    public function submitProposal(Request $request){
        $insert = DataModel::insertData('application',
            array(
                "type" => 1,
                "proposal" => $request->input('proposal'), 
                "job" => $request->input('job'),
                "applicant" => AUTH::user()->id,
                "applicant_type" => AUTH::user()->type,
                "status" => 2,
            )
        );
        return response()->json([
            'status' => $insert,
            'new_jobs' => $this->fetchJobs()
        ]);
    }

    public function groupChats(){
        $params = array(
            'table' => 'group_chat',
            'select'=>array('group_chat.id','group_chat.name','group_chat.key'),
            'where' => array(
                array('application.applicant','=',AUTH::user()->id)
            ),
            "join" => array(
                array('job', 'group_chat.job', '=', 'job.id'),
                array('application', 'group_chat.job', '=', 'application.job')
            )
        );
        return DataModel::getData($params);
    }

    public function recordChats(Request $request){
        $chi = DataModel::insertData('chat',
            array(
                'group_key' => $request->input('key'),
                'user' => AUTH::user()->id,
                'message' => $request->input('message'),
                'type' => AUTH::user()->type
            )
        );
        return response()->json([
            'status' => $chi,
        ]);
    }

    public function getChats(Request $request){
        $params = array(
            'table' => 'chat',
            'select'=>array(
                'id','user','message',
                DB::raw("(select fname from user_freelancer where credential = chat.user) as fname"),
                DB::raw("(select lname from user_freelancer where credential = chat.user) as lname"),
                DB::raw("(select fname from user_employer where credential = chat.user) as efname"),
                DB::raw("(select lname from user_employer where credential = chat.user) as elname"),
                DB::raw("(select fname from user_coordinator where credential = chat.user) as cfname"),
                DB::raw("(select lname from user_coordinator where credential = chat.user) as clname"),
                DB::raw("(select type from credentials where id = chat.user) as type")
            ),
            'where' => array(
                array('group_key','=',$request->input('key'))
            ),
        );
        return response()->json([
            'chats' =>  DataModel::getData($params),
        ]);
    }

    public function floaterGetGroup(Request $request){
        $params = array(
            'table' => 'group_chat',
            'select'=>array('group_chat.id','group_chat.name','group_chat.key','group_chat.status','user_employer.fname','user_employer.lname'),
            'where' => array(
                array('employee.employee','=',AUTH::user()->id)
            ),
            "join" => array(
                array('job', 'group_chat.job', '=', 'job.id'),
                array('employee', 'group_chat.job', '=', 'employee.job'),
                array('user_employer', 'job.owner', '=', 'user_employer.credential'),
            )
        );
        return response()->json([
            'group' =>  DataModel::getData($params),
        ]);
    }

    public function floaterGetSolo(Request $request){
        $params = array(
            'table' => 'solo_chat',
            'select'=>array('solo_chat.id','solo_chat.name','solo_chat.status','solo_chat.key','user_employer.fname','user_employer.lname'),
            'where' => array(
                array('solo_chat.user','=',AUTH::user()->id),
                array('solo_chat.status','!=',3)
            ),
            "join" => array(
                array('job', 'solo_chat.job', '=', 'job.id'),
                array('user_employer', 'job.owner', '=', 'user_employer.credential'),
            )
        );   
        return response()->json([
            'solo' =>  DataModel::getData($params),
        ]);
    }

}
