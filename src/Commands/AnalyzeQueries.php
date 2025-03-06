<?php

namespace SmartDbOptimizer\Commands;

use Illuminate\Console\Command;
use SmartDbOptimizer\Models\QueryLog;

class AnalyzeQueries extends Command
{
    protected $signature = 'smartdb:analyze';
    protected $description = 'Analyze slow queries and suggest optimizations';

    public function handle()
    {
        $slowQueries = QueryLog::where('time', '>', config('smartdb.slow_query_threshold'))->get();
        $this->info("Found " . $slowQueries->count() . " slow queries.");

        foreach ($slowQueries as $query) {
            $this->line("Query: " . $query->query);
            $this->line("Execution Time: " . $query->time . "ms");
            $this->line("------------------------------");
        }

        return 0;
    }
}
