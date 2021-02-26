<?php

namespace App\Http\ViewComposers;
use App\Helper\DataModel;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CoordinatorSideData{
    public function compose(View $view) {
        
        $sidebar_data = array(
            array(
                'title' => "Job Invites",
                'link' => "/coordinator/application",
                'icon' => ""
            ),
            array(
                'title' => "My Jobs",
                'link' => "/coordinator/myjobs",
                'icon' => ""
            ),
            array(
                'title' => "Messenger",
                'link' => "/coordinator/messenger",
                'icon' => ""
            ),
        );

        $params = array(
            "table" => 'user_coordinator',
            "select" => array('fname','lname'),
            "where" => array(
                array('credential','=',AUTH::user()->id)
            )
        );

        $data = array(
            'dashboard_link' => '/employer',
            'sideBar_data'=> $sidebar_data,
            'name'=>DataModel::getData($params)[0]->fname .' '. DataModel::getData($params)[0]->lname ,
            'role'=>'Coordinator'
        );
        $view->with('coordinatorComposer', $data);
    }
}