<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;
class EmployerComposerServiceProvider extends ServiceProvider {
    public function boot() {
        View::composer(
            ['employer.index', 'employer.chatRoom','employer.createJob','employer.jobPost','employer.jobSingleView','employer.room'],
            'App\Http\ViewComposers\EmployerSideData'
        );
    }
}