<?php

namespace App\Http\ViewComposers;
use App\Helper\DataModel;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EmployerSideData{
    public function compose(View $view) {
        
        $sidebar_data = array(
            array(
                'title' => "Create Jobs",
                'link' => "",
                'icon' => ""
            ),
            array(
                'title' => "Job Posted",
                'link' => "/employer/jobPosts",
                'icon' => ""
            ),
            array(
                'title' => "Messenger",
                'link' => "/employer/messenger",
                'icon' => ""
            ),
        );

        $params = array(
            "table" => 'user_employer',
            "select" => array('fname','lname'),
            "where" => array(
                array('credential','=',AUTH::user()->id)
            )
        );

        $data = array(
            'dashboard_link' => '/employer',
            'sideBar_data'=> $sidebar_data,
            'name'=>DataModel::getData($params)[0]->fname .' '. DataModel::getData($params)[0]->lname ,
            'role'=>'Employer'
        );
        $view->with('employerComposer', $data);
    }
}