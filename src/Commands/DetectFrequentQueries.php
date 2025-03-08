<?php

namespace AshokDevatwal\SmartDbOptimizer\Commands;

use Illuminate\Console\Command;
use AshokDevatwal\SmartDbOptimizer\Models\QueryLog;

class DetectFrequentQueries extends Command
{
    protected $signature = 'smartdb:detect-frequent';
    protected $description = 'Identify queries that frequently request the same data in a short time';

    public function handle()
    {
        $queries = QueryLog::detectFrequentQueries();

        if ($queries->isEmpty()) {
            $this->info("No frequently executed queries detected.");
            return 0;
        }

        $this->info("Frequently Executed Queries:");
        foreach ($queries as $query) {
            $this->line("Query: " . $query->query);
            $this->line("Executions: " . $query->count);
            $this->line("----------------------");
        }

        return 0;
    }
}
