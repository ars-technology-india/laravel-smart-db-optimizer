<?php

return [
    'slow_query_threshold' => 100, // Queries taking more than 100ms
    'frequent_query_threshold' => 5, // Number of times a query runs in short time to be flagged
    'frequent_query_time_window' => 60, // Time window in seconds to track repeated queries
];
