<?php

namespace Clipsmm\Workflow;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class WorkflowServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/workflow.php',
            'workflow'
        );

        $this->loadViewsFrom(
            __DIR__ . '/resources/views',
            'workflow'
        );

        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/workflow')
        ], ['workflow', 'views']);

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang')
        ], ['workflow', 'lang']);

        $this->publishes([
            __DIR__ . '/resources/js' => resource_path('js/vendor/workflow')
        ], ['workflow', 'components']);

        $this->publishes([
            __DIR__ . '/config/workflow.php' => config_path('workflow.php'),
        ], ['workflow', 'config']);

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
