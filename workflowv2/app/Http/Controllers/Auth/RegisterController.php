<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function registerFreelancer(){
        return view('auth.registerFreelancer');
    }

    public function handleRegisterFreelance(Request $request){
        $data_for_credentials = array(
            "username" =>$request->input('username'),
            "password" =>Hash::make($request->input('password')),
            "type" => 0,
        );
        $insert = DB::table('credentials')
            ->insertGetId($data_for_credentials);
        $data = array(
            "fname" => $request->input('fname'),
            "lname" => $request->input('lname'),
            "level" => $request->input('level'),
            "bday" => $request->input('bday'),
            "address" => $request->input('address'),
            "employement" => json_encode($request->input('employement')),
            "sss" => $request->input('sss'),
            "pagibig" => $request->input('pagibig'),
            "philhealth" => $request->input('philhealth'),
            "tin" => $request->input('tin'),
            "description" => $request->input('description'),
            "contacts" => json_encode($request->input('contacts')),
            "emails" => json_encode($request->input('emails')),
            "work" => "N/A",
            "education" => json_encode($request->input('education')),
            "skills" => json_encode($request->input('value')),
            "is_deleted" => 0,
            "credential"=>$insert
        );
        $insert_freelancer = DB::table('user_freelancer')
            ->insert($data);

        if ($insert_freelancer) {
            if(Auth::attempt(array('username' => $request->input('username'), 'password' => $request->input('password')))){
                $user= Auth::user();
                $username = $user->username;
                return response()->json([
                    'status'  => true,
                    'user' => $user->type,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'user'   => $request->username
                ]);
            }
        }
    }

    public function registerEmployer(){
        return view('auth.registerEmployer');
    }

    public function handleRegisterEmployer(Request $request){
        $data_for_credentials = array(
            "username" =>$request->input('username'),
            "password" =>Hash::make($request->input('password')),
            "type" => 2,
        );
        $insert = DB::table('credentials')
            ->insertGetId($data_for_credentials);
        $data = array(
            "fname" => $request->input('fname'),
            "lname" => $request->input('lname'),
            "contact" => $request->input('contacts'),
            "company" => $request->input('company'),
            "company_address" => $request->input('company_address'),
            "emails" => $request->input('emails'),
            "credential" => $insert
        );
        $insert_freelancer = DB::table('user_employer')
            ->insert($data);
        if ($insert_freelancer) {
            if(Auth::attempt(array('username' => $request->input('username'), 'password' => $request->input('password')))){
                $user= Auth::user();
                $username = $user->username;
                return response()->json([
                    'status'  => true,
                    'user' => $user->type,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    // 'user'   => $request->username
                ]);
            }
        }
    }

    public function registerCoordinator(){
        return view('auth.registerCoordinator');
    }

    public function handleRegisterCoordinator(Request $request){
        $data_for_credentials = array(
            "username" =>$request->input('username'),
            "password" =>Hash::make($request->input('password')),
            "type" => 1,
        );
        $insert = DB::table('credentials')
            ->insertGetId($data_for_credentials);
        $data = array(
                "fname" => $request->input('fname'),
                "lname" => $request->input('lname'),
                "address" => $request->input('address'),
                "description" => $request->input('description'),
                "sss" => $request->input('sss'),
                "pagibig" => $request->input('pagibig'),
                "tin" => $request->input('tin'),
                "philhealth" => $request->input('philhealth'),
                "contacts" => json_encode($request->input('contacts')),
                "langauge" => json_encode($request->input('language')),
                "emails" => json_encode($request->input('emails')),
                "credential" => $insert
            );
        $insert_coodinator = DB::table('user_coordinator')
                ->insert($data);
    }
}
