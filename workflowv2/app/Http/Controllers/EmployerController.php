<?php

namespace App\Http\Controllers;
use App\Helper\DataModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    
    // kani nga function is mo display ug DASHBOARD for kani nga user
    public function index(){
        return view('employer.index');
    }

    // kani kay view sa create job function
    public function createJobView(){
        return view('employer.createJob');
    }

    public function roomView(Request $request){
        $id=$request->input('id');
        return view('employer.room')->with('job',$id);
    }

    public function jobList(Request $request){
        return view('employer.jobPost')->with('jobs',$this->getJobList());
    }

    public function messenger(Request $request){
        return view('employer.chatRoom')->with('group',$this->groupChats());
    }

    public function getJobList(){
        return DataModel::getData(array(
            "table" => 'job',
            "select" => array(
                'job.*','user_employer.fname','user_employer.lname','user_employer.company',
                DB::raw("(select count(id) from application where job = job.id  and status < 4) as applicants")
            ),
            "where" =>array(
                array('job.owner','=',AUTH::user()->id),
            ),
            "join" => array(
                array('user_employer', 'job.owner', '=', 'user_employer.credential')
            )
        ));
    }

    public function getJobDetail(Request $request){
        $id = $request->input('job_id');
        return response()->json([
            'status' => true,
            "job" => DataModel::getData(array(
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
            ))[0],
        ]);
    }

    public function getApplicants(Request $request){
        $id = $request->input('job_id');
        return response()->json([
            'status' => true,
            "applicant" => DataModel::getData(array(
                "table" => 'application',
                "select" => array('application.id as app_id','application.status','user_freelancer.fname','user_freelancer.lname','user_freelancer.id'),
                "where" =>array(
                    array("application.job", '=',$id),
                    array("application.status", '<',3),
                ),
                
                "join" => array(
                    array('user_freelancer', 'application.applicant', '=', 'user_freelancer.credential')
                )
            )),
        ]);
    }

    public function getEmployee(Request $request){
        $id = $request->input('job_id');
        return response()->json([
            'status' => true,
            "employee" => DataModel::getData(array(
                "table" => 'employee',
                "select" => array('employee.id as employee_id','user_freelancer.fname','user_freelancer.lname','user_freelancer.id', 'user_freelancer.level'),
                "where" =>array(
                    array("employee.job", '=',$id),
                ),
                "join" => array(
                    array('user_freelancer', 'employee.employee', '=', 'user_freelancer.credential')
                )
            )),
        ]);
    }

    // kani kay mag create nig job
    public function createJob(Request $request){
        $form = json_decode($request->input('form'));
        $data_job = array(
            'title' => $form->title,
            'description'=> $form->description,
            'requirements'=> $form->req,
            'vacant' =>intval($form->vacant),
            'hired_job' =>0,
            'owner' =>Auth::user()->id,
            'skills'=>$request->input('skill'),
            'level' => $form->level,
            'salary'=>$form->salary,
        );
        $jobId = DB::table('job')
            ->insertGetId($data_job);

        // Mao ni mohatag invite sa taga freelancer or taga coordinator 0=freelance, 1=coordinator,2=employer
        // kani if freelancer mga freelancer ra iya tagaan invite ang else sa mga coordinator nana
        if ($request->input('is_freelancer') === 'true') {
            $freelancers = json_decode($request->input('freelancer'));
            for ($i=0; $i < count($freelancers) ; $i++) { 
                $data_invite = array(
                    'applicant' =>$freelancers[$i],
                    'applicant_type' => 0,
                    'type'=>0,
                    'job' => $jobId,
                    'inviter'=> Auth::user()->id,
                    'inviter_type'=> Auth::user()->type,
                );
                $invite = DB::table('application')
                ->insert($data_invite);
            }
        }else{
            $coordinator = json_decode($request->input('coordinator'));
            for ($i=0; $i < count($coordinator) ; $i++) { 
                $data_invite = array(
                    'applicant' =>$coordinator[$i],
                    'applicant_type' => 1,
                    'type'=>0,
                    'job' => $jobId,
                    'inviter'=> Auth::user()->id,
                    'inviter_type'=> Auth::user()->type,
                );
                $invite = DB::table('application')
                ->insert($data_invite);
            }
        }
        return response()->json([
            'status' => $invite,
        ]);

    }
    /*
        kani kay ge gamit ni sa :
        1) Create JOb nga form
    */
    public function getAllFreelancers(Request $request){
        $freelancers = DB::table('user_freelancer')
            ->where('level', '>=', $request->input('level'))
            ->orderBy('id', 'desc')
            ->get();
        $static_skill = json_decode($request->input('skill_needed'));
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
            'user'   => array_unique($result,SORT_REGULAR)
        ]);
    }

    public function getDataCoordinator(Request $request){
        $freelancers = DB::table('user_coordinator')
        ->where('credential', '=', $request->input('id'))
        ->get();
        return response()->json([
            'status' => true,
            'user'   => $freelancers[0]
        ]);
    }

    public function getCoordinators(Request $request){
        $coordinator = DB::table('user_coordinator')
        ->get();
        return response()->json([
            'status' => true,
            'user'   => $coordinator
        ]);
    }

    public function getDataFreelancer(Request $request){
        $freelancers = DB::table('user_freelancer')
        ->where('credential', '=', $request->input('id'))
        ->get();
        return response()->json([
            'status' => true,
            'user'   => $freelancers[0]
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



    public function interviews($id){
        return DataModel::getData(array(
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
        ));
    }

    public function getInterviews(Request $request){
        return response()->json([
            'status' => true,
            'interviews'   => $this->interviews($request->input('job_id'))
        ]);
    }
    public function updateInterview(Request $request){
        $updated= DB::table('application')
        ->updateOrInsert(
            ['id' => $request->input('application')],
            ['status' => 5]
        );
        $key = uniqid('interview-1311998',TRUE);

        $addsolo = DataModel::insertData('solo_chat',
            array(
                'name'=>$request->input('title'),
                'job'=>$request->input('job'),
                'application' => $request->input('application'),
                'user'=>$request->input('user'),
                'key'=>$key,
            )
        );

        return response()->json([
            'status' => true,
            'new_interview' => $this->interviews($request->input('job')),
            'key'=> $key
        ]);
    }

    public function hire(Request $request){
        $updated= DB::table('application')
        ->updateOrInsert(
            ['id' => $request->input('application')],
            ['status' => 10]
        );

        $params_app = array(
            "table" => "application",
            "select" => array('application.id','applicant','job','title','applicant_type'),
            "where"=>array(
                array('application.id','=',$request->input('application'))
            ),
            "join"=>array(
                array('job', 'application.job','=','job.id')
            )
        );

        $application = DataModel::getData($params_app)[0];
        // print_r($application);
        // die();
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

    public function groupChats(){
        return DataModel::getData(array(
            'table' => 'group_chat',
            'select'=>array('group_chat.id','group_chat.name','group_chat.key'),
            'where' => array(
                array('job.owner','=',AUTH::user()->id)
            ),
            "join" => array(
                array('job', 'group_chat.job', '=', 'job.id')
            )
        ));
    }

    public function floaterGetGroup(Request $request){
        return response()->json([
            'group' =>  DataModel::getData(array(
                'table' => 'group_chat',
                'select'=>array('group_chat.id','group_chat.name','group_chat.job','group_chat.key','group_chat.status','user_employer.fname','user_employer.lname'),
                'where' => array(
                    array('job.owner','=',AUTH::user()->id)
                ),
                "join" => array(
                    array('job', 'group_chat.job', '=', 'job.id'),
                    array('employee', 'group_chat.job', '=', 'employee.job'),
                    array('user_employer', 'job.owner', '=', 'user_employer.credential'),
                )
            )),
        ]);
    }

    public function floaterGetSolo(Request $request){
        return response()->json([
            'solo' =>  DataModel::getData(array(
                'table' => 'solo_chat',
                'select'=>array('solo_chat.id','solo_chat.name','solo_chat.job','solo_chat.application','solo_chat.status','solo_chat.key','user_employer.fname','user_employer.lname'),
                'where' => array(
                    array('job.owner','=',AUTH::user()->id),
                    array('solo_chat.status','!=',3)
                ),
                "join" => array(
                    array('job', 'solo_chat.job', '=', 'job.id'),
                    array('user_employer', 'job.owner', '=', 'user_employer.credential'),
                )
            )),
        ]);
    }

    public function recordChats(Request $request){
        $chat = array(
            'group_key' => $request->input('key'),
            'user' => AUTH::user()->id,
            'message' => $request->input('message')
        );
        $chi = DB::table('chat')
            ->insert($chat);

            return response()->json([
                'status' => $chi,
            ]);
    }

    public function getChats(Request $request){
        return response()->json([
            'chats' =>  DataModel::getData(array(
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
            )),
        ]);
    }
    
}

