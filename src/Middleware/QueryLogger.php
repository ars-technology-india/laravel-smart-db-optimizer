<?php

namespace AshokDevatwal\SmartDbOptimizer\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use AshokDevatwal\SmartDbOptimizer\Models\QueryLog;

class QueryLogger
{
    public function handle($request, Closure $next)
    {
        DB::listen(function ($query) {
            // Convert the query to lowercase to avoid case sensitivity issues
            $sql = strtolower($query->sql);
        
            // Ignore queries that interact with the query_logs table
            if (str_contains($sql, 'query_logs')) {
                return;
            }
        
            if ($query->time > config('smartdb.slow_query_threshold')) {
                QueryLog::create([
                    'query' => $query->sql,
                    'bindings' => json_encode($query->bindings),
                    'time' => $query->time,
                    'executed_at' => now(),
                ]);
            }
        });

        return $next($request);
    }
}
