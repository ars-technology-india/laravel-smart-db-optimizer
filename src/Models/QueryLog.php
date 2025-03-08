<?php

namespace AshokDevatwal\SmartDbOptimizer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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

    public static function suggestCacheDuration($queryCount)
    {
        if ($queryCount >= 20) return 600; // 10 minutes
        if ($queryCount >= 10) return 300; // 5 minutes
        if ($queryCount >= 5) return 120;  // 2 minutes
        return 0;
    }

    public static function autoCacheQuery($query, $bindings, $duration)
    {
        $cacheKey = md5($query . json_encode($bindings));
        if (!Cache::has($cacheKey)) {
            $result = DB::select($query, json_decode($bindings, true));
            Cache::put($cacheKey, $result, $duration);
        }
        return Cache::get($cacheKey);
    }
}
