<?php

namespace SmartDbOptimizer\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SmartDbOptimizer\Models\QueryLog;

class SuggestIndexes extends Command
{
    protected $signature = 'smartdb:suggest-indexes';
    protected $description = 'Suggest indexes based on slow queries';

    public function handle()
    {
        $queries = QueryLog::all();
        $suggestions = [];

        foreach ($queries as $query) {
            if (preg_match('/FROM\s+(\w+)/', $query->query, $matches)) {
                $table = $matches[1];
                $suggestions[$table][] = $query->query;
            }
        }

        foreach ($suggestions as $table => $queries) {
            $this->info("Table: " . $table);
            $this->info("Consider adding indexes on frequently used WHERE columns.");
        }

        return 0;
    }
}
