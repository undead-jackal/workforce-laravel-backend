<?php

namespace App\Http\Controllers;
use App\Helper\DataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CoordinatorController extends Controller
{
    public function index(){
        return view('coordinator.index');
    }

    public function interviews($id){
        $params = array(
            'table' => 'interview',
            'select'=>array('interview.id','interview.applicants','interview.sched','user_freelancer.fname','user_freelancer.lname', 'application.status','application.job','application.applicant','application.applicant_type','job.title'),
            'where' => array(
                array('application.job','=',$id),
                array('application.status','!=',10)
            ),
            "join" => array(
                array('application', 'interview.applicants', '=', 'application.id'),
                array('user_freelancer', 'application.applicant', '=', 'user_freelancer.credential'),
                array('job', 'application.job', '=', 'job.id')
            )
        );
        return DataModel::getData($params);
    }

    public function getInterviews(Request $request){
        return response()->json([
            'status' => true,
            'interviews'   => $this->interviews($request->input('job'))
        ]);
    }
    public function myJobs(){
        $params = array(
            'table' => 'job',
            'select' => array('*'),
            'where' => array(
                array('coordinator','=',AUTH::user()->id)
            )
        );
        $jobs = DataModel::getData($params);
        return view('coordinator.coordinator')->with('jobs', $jobs);
    }

    public function application(){
        $params = array(
            'table' => 'application',
            'select' => array('application.*','job.owner','job.title','user_employer.fname','user_employer.lname'),
            'where' => array(
                array('applicant','=',AUTH::user()->id),
                array('application.status','=',0)

            ),
            'join' => array(
                array('job','application.job','=','job.id'),
                array('user_employer','job.owner','=','user_employer.credential'),
            )
        );
        $invites = DataModel::getData($params);
        return view('coordinator.applications')->with('myinvites', $invites);
    }

    public function acceptInvite(Request $request){
        $updated= DB::table('application')
        ->updateOrInsert(
            ['id' => $request->input('application')],
            ['status' => 1]
        );
        $updated= DB::table('job')
        ->updateOrInsert(
            ['id' => $request->input('job')],
            ['coordinator' => AUTH::user()->id]
        );

        $key = uniqid('employer-1311998',TRUE);

        $solo_chat_data = array(
            'name'=>$request->input('title'),
            'job'=>$request->input('job'),
            'application' => $request->input('application'),
            'user'=>$request->input('user'),
            'key'=>$key,
        );

        $addsolo = DB::table('solo_chat')
                ->insert($solo_chat_data);
    }

    public function room(Request $request){
        $id=$request->input('id');
        return view('coordinator.room')->with('job',$id);
    }

    public function getApplicant(Request $request){
        $id = $request->input('job');
        $params = array(
            "table" => 'application',
            "select" => array('application.id as app_id','application.status','user_freelancer.fname','user_freelancer.lname','user_freelancer.id',),
            "where" =>array(
                array("application.job", '=',$id),
                array("application.status", '<',3),
                array("job.coordinator", '=',AUTH::user()->id),
            ),
            
            "join" => array(
                array('user_freelancer', 'application.applicant', '=', 'user_freelancer.credential'),
                array('job', 'application.job', '=', 'job.id')
            )
        );
        return response()->json([
            'status' => true,
            "applicant" => DataModel::getData($params),
        ]);
    }

    public function setInterview(Request $request){
        $addInterview = array(
            'sched' =>date_format(date_create($request->input('sched')),"n-j-Y, h:i A"),
            'applicants' => $request->input('id'),
            'reminder' => $request->input('reminder'),
        );
        $addedInterview = DB::table('interview')
        ->insert($addInterview);

        $updated= DB::table('application')
        ->updateOrInsert(
            ['id' => $request->input('id')],
            ['status' => 4]
        );
        return response()->json([
            'status' => true,
            'user'   => $addedInterview
        ]);
    }

    public function getFreelancer(Request $request){
        $id = $request->input('job');
        $params = array(
            "table" => 'job',
            "select"=>array("skills","level"),
            "where" => array(
                array("id","=",$id)
            )
        );
        $jobs = DataModel::getData($params)[0];

        $freelancers = DB::table('user_freelancer')
        ->select('id','credential','fname','lname','skills','level')
        ->where('level', '>=', $jobs->level)
        ->orderBy('id', 'desc')
        ->get();
        $static_skill = json_decode($jobs->skills);
        $result = array();
        foreach ($freelancers as $key){ 
            $skills_f = json_decode($key->skills);
            for ($i=0; $i < count($static_skill); $i++) { 
                for ($j=0; $j < count($skills_f); $j++) { 
                    if ($static_skill[$i]->name == $skills_f[$j]->name && $static_skill[$i]->rating <= $skills_f[$j]->rating) {
                        array_push($result, $key);
                    }
                }
            }
        }
        return response()->json([
            'status' => true,
            'freelancers'   => array_unique($result,SORT_REGULAR)
        ]);
    }

    public function Invite(Request $request){
        $invite = array(
            'applicant' =>$request->input('id'),
            'applicant_type' => 0,
            'type'=>0,
            'job' => $request->input('job'),
            'inviter'=> Auth::user()->id,
            'inviter_type'=> Auth::user()->type,
        );
        $addInvite = DB::table('application')
        ->insert($invite);

        return response()->json([
            'status' => true,
            'freelancers'   => ''
        ]);
    }

    public function getJobDetail(Request $request){
        $id = $request->input('job');
        $params = array(
            "table" => 'job',
            "select" => array(
                'job.*','user_employer.fname','user_employer.lname','user_employer.company',
                DB::raw("(select count(id) from proposal where job = job.id and status = 0) as proposal_applicants"),
                DB::raw("(select count(id) from invite where job = job.id and status = 1) as invite_applicants")
            ),
            "where" =>array(
                array("job.id", '=',$id),
            ),
            "join" => array(
                array('user_employer', 'job.owner', '=', 'user_employer.credential')
            )
        );
        return response()->json([
            'status' => true,
            "job" => DataModel::getData($params)[0],
        ]);
    }

    public function updateInterview(Request $request){
        $updated= DB::table('application')
        ->updateOrInsert(
            ['id' => $request->input('application')],
            ['status' => 5]
        );
        $key = uniqid('interview-1311998',TRUE);
        $solo_chat_data = array(
            'name'=>$request->input('title'),
            'job'=>$request->input('job'),
            'application' => $request->input('application'),
            'user'=>$request->input('user'),
            'key'=>$key,
        );

        $addsolo = DB::table('solo_chat')
                ->insert($solo_chat_data);

        return response()->json([
            'status' => true,
            'new_interview' => $this->interviews($request->input('job')),
            'key'=> $key
        ]);
    }

    public function messenger(Request $request){
        return view('coordinator.chatRoom');
    }

    public function groupChats(Request $request){
        $params = array(
            'table' => 'group_chat',
            'select'=>array('group_chat.id','group_chat.name','group_chat.key'),
            'where' => array(
                array('job.coordinator','=',AUTH::user()->id),
            ),
            "join" => array(
                array('job', 'group_chat.job', '=', 'job.id')
            )
        );
        return DataModel::getData($params);
    }

    public function floaterGetGroup(Request $request){
        return response()->json([
            'group' =>  DataModel::getData(
                array(
                    'table' => 'group_chat',
                    'select'=>array('group_chat.id','group_chat.name','group_chat.job','group_chat.key','group_chat.status','user_employer.fname','user_employer.lname'),
                    'where' => array(
                        array('job.coordinator','=',AUTH::user()->id),
                        array('group_chat.job','=',$request->input('job'))
                    ),
                    "join" => array(
                        array('job', 'group_chat.job', '=', 'job.id'),
                        array('employee', 'group_chat.job', '=', 'employee.job'),
                        array('user_employer', 'job.owner', '=', 'user_employer.credential'),
                    )
                )
            )[0],
        ]);
    }

    public function floaterGetSolo(Request $request){
        return response()->json([
            'solo' =>  DataModel::getData(
                array(
                    'table' => 'solo_chat',
                    'select'=>array('solo_chat.id','solo_chat.name','solo_chat.job','solo_chat.application','solo_chat.status','solo_chat.key','user_employer.fname','user_employer.lname'),
                    'where' => array(
                        array('job.coordinator','=',AUTH::user()->id),
                        array('solo_chat.status','!=',3)
                    ),
                    "join" => array(
                        array('job', 'solo_chat.job', '=', 'job.id'),
                        array('user_employer', 'job.owner', '=', 'user_employer.credential'),
                    )
                )
            ),
        ]);
    }

    public function recordChats(Request $request){
        $chat = array(
            'group_key' => $request->input('key'),
            'user' => AUTH::user()->id,
            'message' => $request->input('message'),
            'type'=>AUTH::user()->type
        );
        $chi = DB::table('chat')
            ->insert($chat);

            return response()->json([
                'status' => $chi,
            ]);
    }

    public function getChats(Request $request){
        return response()->json([
            'chats' =>  DataModel::getData(
                array(
                    'table' => 'chat',
                    'select'=>array(
                        'id','user','message',
                        DB::raw("(select fname from user_freelancer where credential = chat.user) as fname"),
                        DB::raw("(select lname from user_freelancer where credential = chat.user) as lname"),
                        DB::raw("(select fname from user_employer where credential = chat.user) as efname"),
                        DB::raw("(select lname from user_employer where credential = chat.user) as elname"),
                        DB::raw("(select type from credentials where id = chat.user) as type")
                    ),
                    'where' => array(
                        array('group_key','=',$request->input('key'))
                    ),
                )
            ),
        ]);
    }

    public function hire(Request $request){
        $updated= DB::table('application')
        ->updateOrInsert(
            ['id' => $request->input('application')],
            ['status' => 10]
        );

        $application = DataModel::getData(
            array(
                "table" => "application",
                "select" => array('application.id','applicant','job','title','applicant_type'),
                "where"=>array(
                    array('application.id','=',$request->input('application'))
                ),
                "join"=>array(
                    array('job', 'application.job','=','job.id')
                )
            )
        )[0];

        $updated= DB::table('solo_chat')
        ->updateOrInsert(
            ['user' => $application->applicant,'job' =>$application->job],
            ['status' => 3]
        );

        $params = array(
            "table" => "group_chat",
            "select" => "id",
            "where"=>array(
                array('job','=',$application->job)
            )
        );

        if(count(DataModel::getData($params)) == 0){
            $key = uniqid($request->input('title').'-1311998',TRUE);

            $data = array(
                "name" =>$application->title,
                "job"=>$application->job,
                "key"=>$key
            );

            $addGroup = DB::table('group_chat')
                ->insert($data);
        };

        $data = array(
            "employee"=>$application->applicant,
            "employee_type"=>$application->applicant_type,
            "job"=>$application->job,
        );

        $jobId = DB::table('employee')
            ->insertGetId($data);
    }

    public function getEmployee(Request $request){
        $id = $request->input('job');
        $params = array(
            "table" => 'employee',
            "select" => array('employee.id as employee_id','user_freelancer.fname','user_freelancer.lname','user_freelancer.id', 'user_freelancer.level'),
            "where" =>array(
                array("employee.job", '=',$id),
            ),
            "join" => array(
                array('user_freelancer', 'employee.employee', '=', 'user_freelancer.credential')
            )
        );
        return response()->json([
            'status' => true,
            "employee" => DataModel::getData($params),
        ]);
    }
    
}
