<?php

namespace AshokDevatwal\SmartDbOptimizer\Models;

use Illuminate\Database\Eloquent\Model;

class QueryLog extends Model
{
    protected $fillable = ['query', 'bindings', 'time', 'executed_at'];

    public static function detectFrequentQueries($threshold = 5, $interval = 10)
    {
        return DB::table('query_logs')
            ->select('query', DB::raw('COUNT(*) as count'))
            ->where('executed_at', '>=', now()->subSeconds($interval))
            ->groupBy('query')
            ->having('count', '>=', $threshold)
            ->get();
    }
}
