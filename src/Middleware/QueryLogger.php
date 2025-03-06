<?php

namespace SmartDbOptimizer\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use SmartDbOptimizer\Models\QueryLog;

class QueryLogger
{
    public function handle($request, Closure $next)
    {
        DB::listen(function ($query) {
            if ($query->time > config('smartdb.slow_query_threshold')) {
                QueryLog::create([
                    'query' => $query->sql,
                    'bindings' => json_encode($query->bindings),
                    'time' => $query->time,
                ]);
            }
        });

        return $next($request);
    }
}
