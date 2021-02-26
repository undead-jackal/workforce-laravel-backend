<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;
class CoordinatorComposerServiceProvider extends ServiceProvider {
    public function boot() {
        View::composer(
            ['coordinator.index','coordinator.applications','coordinator.coordinator','coordinator.room','coordinator.chatRoom'],
            'App\Http\ViewComposers\CoordinatorSideData'
        );
    }
}