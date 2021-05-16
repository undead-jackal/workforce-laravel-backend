<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\DataPayload;
use Illuminate\Support\Facades\Hash;
use Image4IO\Image4ioApi;


class AuthController extends Controller{
    private $apiKey = 't7Chy1X3hT4rpV1hBjpHfw==';
    private $apiSecret = 'oNSMY7wUounQFbvfgKnEbsG1sMor1RkzS4VDt7Ldvv4=';

    public function createNotification(Request $request){
        $notification = array(
            "to"=>$request->input('to'),
            "from"=>$request->input('from'),
            "type" => $request->input('type')
        );

        $insert = DataPayload::insertData('notification',$notification);
        return $insert;
    }

    public function getNotification(Request $request){
        $select= array(); $where= array(); $join = array();
        if($request->input('isLatest')){
            $select= array('notification.id');
            $where = array(
                array('notification.status','=',0),
                array('job.owner','=',$request->input('id'))

            );
            $join = array(
                array('job', 'notification.to', '=', 'job.id'),
                array('user_info', 'notification.from', '=', 'user_info.credential'),
            );
        }else{
            $select = array('job.owner','job.title', 'user_info.fname', 'user_info.lname', 'notification.type', 'notification.from');
            $where = array(
                array('notification.id','=',$request->input('id')),
                array('notification.status','=',0)
            );
            $join = array(
                array('job', 'notification.to', '=', 'job.id'),
                array('user_info', 'notification.from', '=', 'user_info.credential'),
                array('application', 'notification.from', '=', 'application.applicant')
            );
        }

        return DataPayload::getData(array(
            'table' => 'notification',
            'select' =>$select,
            'where' => $where,
            "join" => $join
        ));
    }

    public function updateNotification(Request $request){
        $update = DataPayload::updateData(
            'notification',
            array(
                "status" => 1
            ),
            array(
                array('id', $request->input('id'))
            ),
        );
        return $update;
    }

    public function register(Request $request){
        $data = array(
            "username" => $request->input('username'),
            "password" => Hash::make($request->input('password')),
            "logintoken"=>uniqid('workforce-',true),
            "role"=>$request->input('role')
        );
        $userId = DataPayload::insertData('user_credentials',$data);

        $data_user = array(
            "fname"=>$request->input('fname'),
            "lname"=>$request->input('lname'),
            "credential"=>$userId,
            "profile"=>'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'
        );

        $profileStat = array(
            "cover" => 0,
            "profile"=>0,
            "personal" => 0,
            "skill"=>0,
        );

        $insertSettings = DataPayload::insertData('user_settings',array(
            'user'=>$userId,
            'profileStats'=>json_encode($profileStat)
        ));

        $insert = DataPayload::insertData('user_info',$data_user);
        if ($insert) {
            return response()->json([
                'status' => true,
                'data' => $userId,
            ]);
        }else {
            return response()->json([
                'status' => false,
            ]);
        }
    }


        public function recordChat(Request $request){
            $chat = array(
                'group_key' => $request->input('key'),
                'user' => $request->input('id'),
                'message' => $request->input('message')
            );
            $record = DataPayload::insertData('chat',$chat);
            return response()->json([
                'status' => $record,
            ]);
        }

        public function getListChats(Request $request){
            return DataPayload::getData(array(
                'table' => 'solo_chat',
                'where' => array(
                    array('application.applicant','=',$request->input('id'))
                ),
                "join" => array(
                    array('job', 'solo_chat.job', '=', 'job.id'),
                    array('application', 'solo_chat.job', '=', 'application.job')
                )
            ));
        }

    public function uploadImage(Request $request){
        $api = new Image4ioApi($this->apiKey, $this->apiSecret);
        $result = $api->uploadImage( $request->file('file'),'workforce/system');
        $update = DataPayload::updateData(
            'user_info',
            array(
                "profile" => json_decode($result['content'],true)['uploadedFiles'][0]['url'],
                "status"=> 2
            ),
            array(
                array('credential', $request->input('id'))
            ),
        );

        $profSet = json_decode($request->input('profileSet'));
        $profSet->profile = 1;

        $updateSettings = DataPayload::updateData(
            'user_settings',
            array(
                "profileStats" => json_encode($profSet)
            ),
            array(
                array('user', $request->input('id'))
            ),
        );
        return response()->json([
            'data' => json_decode($result['content'],true)['uploadedFiles'][0]['url'],
            'newUserSet'=>json_encode($profSet)
        ]);
    }


    public function getChat(Request $request){
        return DataPayload::getData(array(
            'table' => 'chat',
            'select' =>array('chat.id','chat.user','chat.message','chat.group_key','user_info.fname','user_info.lname'),
            "where" =>array(
                array('group_key','=',$request->input('key'))
            ),
            "join" => array(
                array('user_info', 'chat.user', '=', 'user_info.credential'),
            ),
            "desc" => array(
                array('chat.id', 'asc'),
            )
        ));
    }

    public function getProfile(Request $request){
        $select = array('*');
        if ($request->input('only_name')) {
            $select = array('fname','lname');
        }
        $data = DataPayload::getData(
            array(
                "table" => 'user_info',
                "select"=>$select,
                "where"=>array(
                    array('credential','=',$request->input('id')),
                )
            )
        );
        return response()->json([
            'status' => true,
            'data' => $data[0]
        ]);
    }

    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $data = DataPayload::getData(
            array(
                "table" => 'user_credentials',
                "select" => array('user_credentials.*','user_info.fname','user_info.lname','user_info.profile','user_info.status as profileStatus','user_settings.manual','user_settings.profileStats'),
                "where"=>array(
                    array('user_credentials.username','=',$username),
                ),
                "join" => array(
                    array('user_info', 'user_credentials.id', '=', 'user_info.credential'),
                    array('user_settings', 'user_credentials.id', '=', 'user_settings.user')
                )
            )
        );
        if(count($data) != 0){
            if(Hash::check($password,$data[0]->password)){
                return response()->json([
                    'status' => true,
                    'data' => $data[0]
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'data' => "Wrong Password"
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'data' => ""
            ]);
        }
    }

    public function checkSchedule(Request $request){
        $select= array('sched', 'interview.applicants');
        $where = array(
            array('application.applicant', '=',$request->input('user'))
        );
        $join= array(
            array('application', 'interview.applicants', '=', 'application.id')
        );
        $result = DataPayload::getData(array(
            "table" => 'interview',
            "select" => $select,
            "where" =>$where,
            "join" =>$join
        ));
        $dates = array();
        for ($i=0; $i <  count($result); $i++) { 
            $convertedDate = date("Y-m-d", strtotime($result[$i]->sched));
            if(strtotime($convertedDate) == strtotime(date('Y-m-d'))){
                $status = 4;
            }
            if(strtotime($result[$i]->sched) < strtotime(date('Y-m-d'))){
                $status = 7; 
            }

            $update = DataPayload::updateData(
                'application',
                array(
                    "status" => $status
                ),
                array(
                    array('id', $result[$i]->applicants)
                ),
            );
        }
        return $dates;
    }

    public function userSetting(Request $request){
        if($request->input('setting') == "manual"){
            $update = DataPayload::updateOrInsertData(
                'user_settings',
                array(
                    "user"=>$request->input('user'),
                ),
                array(
                    "user"=>$request->input('user'),
                    "manual" => $request->input('manual'),
                ),
            );
            return $update;
        }
    }

    public function updateProfile(Request $request){
        $data = array(
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'address' => $request->input('address'),
            'contacts' =>$request->input('contacts'),
            'emails' =>$request->input('emails'),
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
        // update profile progress
        $profSet = json_decode($request->input('profileSet'));
        if($request->input('cover') != null || $request->input('cover') != ''){
            $profSet->cover = 1;
        };

        if($request->input('address') != '' && $request->input('contacts') != '' && $request->input('emails') != ''){
            $profSet->personal = 1;
        };

        if(count(json_decode($request->input('skills'))) != 0){
            $profSet->skill = 1;
        }
        $updateSettings = DataPayload::updateData(
            'user_settings',
            array(
                "profileStats" => json_encode($profSet)
            ),
            array(
                array('user', intVal($request->input('id')))
            ),
        );
        // ================================

        $update = DataPayload::updateData(
            'user_info',
            $data,
            array(
                array('credential', intVal($request->input('id')))
            ),
        );
        return response()->json([
            'status' => true,
            'newUserSet'=>json_encode($profSet),
            'test' => gettype($request->input('skills'))
        ]);
    }
}
