<?php

namespace App\Http\ViewComposers;
use App\Helper\DataModel;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FreelancerSideData{
    public function compose(View $view) {
        

        $params = array(
            "table" => 'user_freelancer',
            "select" => array('fname','lname'),
            "where" => array(
                array('credential','=',AUTH::user()->id)
            )
        );

        $sidebar_data = array(
            array(
                'title' => "Find Jobs",
                'link' => "/freelancer/jobs",
                'icon' => "fas fa-briefcase"
            ),
            array(
                'title' => "My Applications",
                'link' => "/freelancer/jobInvites",
                'icon' => "fas fa-file-alt"
            ),
            array(
                'title' => "My Jobs",
                'link' => "/freelancer/myJobs",
                'icon' => "fas fa-business-time"
            ),
            array(
                'title' => "Messenger",
                'link' => "/freelancer/messenger",
                'icon' => ""
            ),
        );
        $data = array(
            'dashboard_link' => '/freelancer',
            'sideBar_data'=> $sidebar_data,
            'name'=>DataModel::getData($params)[0]->fname .' '. DataModel::getData($params)[0]->lname ,
            'role'=>'Freelancer'
        );
        $view->with('freelancerComposer', $data);
    }
}