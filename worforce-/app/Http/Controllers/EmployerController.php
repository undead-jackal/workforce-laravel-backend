<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function jobList_view(){
        return view('employer.jobList');
    }
    public function manage_view(){
        return view('employer.manage');
    }

    public function applicant_view(){
        return view('employer.applicants');
    }

    public function profile_view(){
        return view('employer.profile');
    }

    public function wallet_view(){
        return view('employer.wallet');
    }

    public function login(){
        return view('employer.login');
    }

    public function register(){
        return view('employer.register');
    }
}
