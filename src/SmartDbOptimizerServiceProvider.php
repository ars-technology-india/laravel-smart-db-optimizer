<?php

namespace SmartDbOptimizer;

use Illuminate\Support\ServiceProvider;
use SmartDbOptimizer\Middleware\QueryLogger;

class SmartDbOptimizerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/smartdb.php', 'smartdb');
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \SmartDbOptimizer\Commands\AnalyzeQueries::class,
                \SmartDbOptimizer\Commands\SuggestIndexes::class,
            ]);
        }

        app('router')->pushMiddlewareToGroup('web', QueryLogger::class);
    }
}
