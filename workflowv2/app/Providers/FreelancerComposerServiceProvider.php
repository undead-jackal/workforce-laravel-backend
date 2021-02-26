<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;
class FreelancerComposerServiceProvider extends ServiceProvider {
    public function boot() {
        View::composer(
            ['freelancer.index', 'freelancer.chatRoom','freelancer.fetchjobs','freelancer.jobInvites','freelancer.myjobs'],
            'App\Http\ViewComposers\FreelancerSideData'
        );
    }
}